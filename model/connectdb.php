<?php 
$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME); 
if ($conn->connect_error) {
	die("ket noi that bai: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
?>