<?php 
//router
session_start();
require '../config.php';
require '../connectDB.php';
require '../bootstrap.php';
require '../vendor/autoload.php';
// controller
$c = $_GET['c'] ?? 'home';
$a = $_GET['a'] ?? 'index';
$controller = ucfirst($c) . 'Controller';
require "controller/$controller.php";
$controller = new $controller();
$controller->$a();


?>