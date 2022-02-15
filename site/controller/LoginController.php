<?php 
class LoginController {
    function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if (empty($customer)) {
            $_SESSION['error'] = 'Sai email hoặc password, vui lòng đăng nhập lại';
            header('location: /');
            exit;
        }
        if (!password_verify($password, $customer->getPassword())) {
            $_SESSION['error'] = 'Sai email hoặc password, vui lòng đăng nhập lại';
            header('location: /');
            exit;
        }

        if ($customer->getIsActive() == 0) {
            $_SESSION['error'] = 'Vui lòng check email để active account';
            header('location: /');
            exit;
        }

        $_SESSION['email'] = $email;
        $_SESSION['name'] = $customer->getName();
        header('location: /');
        exit;

    }

    function logout() {
        session_destroy();//hủy tất cả các session ($_SESSION sẽ empty)
        header('location:/');
    }
}
?>