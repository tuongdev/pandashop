<?php 
use \Firebase\JWT\JWT;
class AuthController {
	function login() {
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->findUsernameAndPassword($username, $password);
		if (!empty($staff)) {
			//check active or not
			
			if ($staff->getIsActive()==0) {
				//Login thất bại. Về login.php
				$_SESSION["error"] = "Tài khoản bị vô hiệu hóa. Vui lòng liên hệ người quản trị";
				header("location:login.php");
				exit;
			}
			//Đã login thành công
			$_SESSION["username"] = $username;
			$_SESSION["name"] = $staff->getName();

			//Lưu thêm trong cookie
			if (!empty($_POST["remember-me"])) {
				$key = REMEMBER_ME_KEY;
				$payload = array(
				    "username" => $username,
				    "name" => $staff->getName()
				);
				$token = JWT::encode($payload, $key);
				setcookie("token", $token, time()+ 24 * 60 * 60 );
			}
			header("location:index.php");
		}
		else {
			//Login thất bại. Về login.php
			$_SESSION["error"] = "Sai username hoặc password";
			header("location:login.php");
		}
	}

	function logout() {
		session_destroy();
		setcookie("token", "", time() - 60);
		header("location:login.php");
	}
}
?>