<?php
session_start();
if (empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}
require_once("../db.php");

if (isset($_POST['password'])) {
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$password = base64_encode(strrev(md5($password)));

	$stmt = $conn->prepare("UPDATE users SET password=? WHERE id_user=?");
	$stmt->bind_param("si", $password, $_SESSION['id_user']);

	if ($stmt->execute()) {
		header("Location: index.php");
		exit();
	} else {
		echo $conn->error;
	}
	$stmt->close();
} else {
	header("Location: settings.php");
	exit();
}
?>
