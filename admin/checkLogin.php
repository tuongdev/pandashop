<?php 
use \Firebase\JWT\JWT;
if (empty($_SESSION["username"])) {
	if (!empty($_COOKIE["token"])) {
		//giải mã
		$key = REMEMBER_ME_KEY;
		try {
			$payload = JWT::decode($_COOKIE["token"], $key, array('HS256'));

			$_SESSION["username"] = $payload->username;
			$_SESSION["name"] = $payload->name;
		} catch(Exception $e) {
			echo "You try to hack!!!";
			exit;
		}
	}
	else {
		header("location:login.php");
		exit;
	}
	
}
?>