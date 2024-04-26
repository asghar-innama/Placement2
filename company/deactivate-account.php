<?php
session_start();
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}
require_once("../db.php");

if(isset($_POST)) {
	$sql = "UPDATE company SET active=? WHERE id_company=?";
	$stmt = $conn->prepare($sql);
	$active_status = 3;
	$stmt->bind_param("ii", $active_status, $_SESSION['id_company']);
	if($stmt->execute()) {
		header("Location: ../logout.php");
		exit();
	} 
	else {
		echo $conn->error;
	}
} 
else {
	header("Location: settings.php");
	exit();
}
?>