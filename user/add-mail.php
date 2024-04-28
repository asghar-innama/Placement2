<?php
session_start();
if (empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}
require_once("../db.php");
if (isset($_POST['subject']) && isset($_POST['description']) && isset($_POST['to'])) {
	$to = $_POST['to'];
	$subject = $_POST['subject'];
	$message = $_POST['description'];
	$stmt = $conn->prepare("INSERT INTO mailbox (id_fromuser, fromuser, id_touser, subject, message) VALUES (?, 'user', ?, ?, ?)");
	$stmt->bind_param("iiss", $_SESSION['id_user'], $to, $subject, $message);

	if ($stmt->execute()) {
		header("Location: mailbox.php");
		exit();
	} else {
		echo $stmt->error;
	}
} else {
	header("Location: mailbox.php");
	exit();
}
?>