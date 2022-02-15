<?php 
use Firebase\JWT\JWT;
class CustomerController {
    protected function checkLogin() {
        if (empty($_SESSION['email'])) {
            header('location:/');
            exit;
        }
    }

    function show() {
        $this->checkLogin();
        $customerRepository = new CustomerRepository();
        $email = $_SESSION['email'];
        $customer = $customerRepository->findEmail($email);
        require 'view/customer/show.php';
    }

    function update() {
        $this->checkLogin();
        $customerRepository = new CustomerRepository();
        $email = $_SESSION['email'];
        $customer = $customerRepository->findEmail($email);
        $customer->setName($_POST['fullname']);
        $customer->setMobile($_POST['mobile']);

       
        if (!empty($_POST['password'])) {
                $currentPassword = $_POST['current_password'];
                if (password_verify($currentPassword, $customer->getPassword())) {
                    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $customer->setPassword($newPassword);
                }
                else {
                    $_SESSION['error'] = 'Password hiện không đúng, vui lòng nhập lại';
                    header('location:?c=customer&a=show');
                    exit;
                }
        }
        if($customerRepository->update($customer)) {
            $_SESSION['success'] = 'Đã cập nhật thành công';
            $_SESSION['name'] = $customer->getName();
        }
        else {
            $_SESSION['error'] = $customerRepository->getError();
        }

        header('location:?c=customer&a=show');
    }
    
    function defaultShipping() {
        $this->checkLogin();
        $email = $_SESSION["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);

        include "layout/variable_address.php";
		require "view/customer/defaultShipping.php";
	}

	function updateDefaultShipping() {
        $this->checkLogin();
		$email = $_SESSION["email"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		$customer->setShippingName($_POST["fullname"]);
		$customer->setShippingMobile($_POST["mobile"]);
		$customer->setHousenumberStreet($_POST["address"]);
		$customer->setWardId($_POST["ward"]);

		if ($customerRepository->update($customer)) {
			$_SESSION["success"] = "Cập nhật địa chỉ giao hàng mặc định thành công";
		}
		else {
			$_SESSION["error"] = "Cập nhật địa chỉ giao hàng mặc định thất bại";
		}
		header("location: index.php?c=customer&a=defaultShipping");
	}

    function orders() {
        $this->checkLogin();
		$email = $_SESSION["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        $orderRepository = new OrderRepository();
		$orders = $orderRepository->getByCustomerId($customer->getId());
		require "view/customer/orders.php";
	}

	function orderDetail() {
        $this->checkLogin();
		$orderRepository = new OrderRepository();
		$id = $_GET["id"];
		$order = $orderRepository->find($id);
		require "view/customer/orderDetail.php";
	}
    
	function notExistingEmail() {
        $email = $_GET["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if (!$customer) {
            echo "true";
            return;
        }
        echo "false";
        return;
    }

    function register() {
		$secret = GOOGLE_RECAPTCHA_SECRET;
		$remoteIp = "127.0.0.1";
		$recaptcha = new \ReCaptcha\ReCaptcha($secret);
		$gRecaptchaResponse = $_POST["g-recaptcha-response"];
		$resp = $recaptcha->setExpectedHostname(get_host_name())
		->verify($gRecaptchaResponse, $remoteIp);

		if ($resp->isSuccess()) {
            
			// Verified!
		    //Lưu xuống database
			$data = [];
			$data["name"] = $_POST["fullname"];
			$data["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT);
			$data["mobile"] = $_POST["mobile"];
			$data["email"] = $_POST["email"];
			$data["login_by"] = "form";
			$data["shipping_name"] = $_POST["fullname"];
			$data["shipping_mobile"] =  $_POST["mobile"];
			$data["ward_id"] = null;
			$data["is_active"] = 0;
			$data["housenumber_street"] = "";
			$customerRepository = new CustomerRepository();
			if ($customerRepository->save($data)) {

				$_SESSION["success"] = "Bạn đã tạo được tài khoản thành công. Vui lòng vào email để kích hoạt tài khoản";
		    	//Gởi mail để kích hoạt tài khoản
				$emailService = new MailService();
				$to = $_POST["email"];
				$subject = "Godashop: Active Account";
				$name = $_POST["fullname"];

				$key = JWT_KEY;
				$payload = array(
					"email" => $to,
					"timestamp" => time()
				);

				$token = JWT::encode($payload, $key);

				$linkActiveAccount = get_domain_site()."/index.php?c=customer&a=activeAccount&token=$token";
				$message = "
				Dear $name,
				Please click bellow button to active your account
				<br>
				<a href='$linkActiveAccount'>Active Account</a>
				";
				$emailService->send($to, $subject, $message);

			}
			else {
				$_SESSION["error"] = $customerRepository->getError();

			}
		}
		else {
			$_SESSION["error"] = "Xác thực recaptcha thất bại";
		}

		header("location: index.php");
	}

	function activeAccount() {
        $code = $_GET["token"];
        try {
            $decoded = JWT::decode($code, JWT_KEY, array('HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
            if (!$customer) {
                $_SESSION["error"] = "Email $email không tồn tại";
                header("location: /");
            }
            $customer->setIsActive(1);
            $customerRepository->update($customer);
            $_SESSION["success"] = "Tài khoản của bạn đã được active";
            //Cho phép login luôn
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $customer->getName();
            header("location: /");
        }
        catch(Exception $e) {
            echo "You try hack!";
        }
        
    }

	function forgotPassword() {
		//Gởi email để reset tài khoản
		$email = $_POST["email"];
		//check email existing
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		if (!$customer) {
			$_SESSION["error"] = "$email không tồn tại";
			header("location: index.php");
			exit;
		}
		$mailServer = new MailService();

		$key = JWT_KEY;
		$payload = array(
			"email" => $email
		);
		$code = JWT::encode($payload, $key);
		$activeUrl= get_domain_site(). "/index.php?c=customer&a=resetPassword&code=$code";
		$content = "
			Chào $email, <br>
			Vui lòng click vào click vào link bên dưới để thiết lập lại password <br>
			<a href='$activeUrl'>Reset Password</a>
		";
		$mailServer->send($email, "Reset Password", $content);
		$_SESSION["success"] = "Vui lòng check email để reset password";
		header("location: index.php");
	}

	function resetPassword() {
		$code = $_GET["code"];
        try {
            $decoded = JWT::decode($code, JWT_KEY, array('HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
            if (!$customer) {
                $_SESSION["error"] = "Email $email không tồn tại";
                header("location: /");
            }
            require "view/customer/resetPassword.php";
			// echo "No error";
        }
        catch(Exception $e) {
            echo "You try hack!";
        }
	}

	function updatePassword() {
		$code = $_POST["code"];
        try {
            $decoded = JWT::decode($code, JWT_KEY, array('HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
			$newPassword = $_POST["password"];
			$hashNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $customer->setPassword($hashNewPassword);
			$customerRepository->update($customer);
			$_SESSION["success"] = "Password resets successfully";
			header("location: index.php");
			// echo "No error";
        }
        catch(Exception $e) {
            echo "You try hack!";
        }
	}

}
?>