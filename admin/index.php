<?php 
	require "../config.php";
	require "../connectDB.php";
	include "../bootstrap.php";
	$c = isset($_GET["c"]) ? $_GET["c"] : "dashboard";
	$a = isset($_GET["a"]) ? $_GET["a"] : "list";
	include "load.php";
	session_id() || session_start();
	if (!($c == "auth" && $a == "login")) {
		include "checkLogin.php";
		//Đã login
	}
	//Check ACL
	if (!empty($_SESSION["username"])) {
		$aclService = new AclService();
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->findUsername($_SESSION["username"]);
		if (!$aclService->hasPermission($staff, $c, $a)) {
			$_SESSION["error"] = $aclService->getMessage();
			header("location: index.php");
			exit;
		}
	}
	// var_dump($_SESSION);
	$classController = ucfirst($c)."Controller";
	$controller = new $classController();
	$controller->$a();