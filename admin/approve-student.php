<?php

session_start();

if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
	exit();
}

require_once("../db.php");

if(isset($_GET['id'])) {

	// Prepare and bind SQL statement with prepared statement
	$sql = "UPDATE company SET active='1' WHERE id_company=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_GET['id']);

	// Execute the update statement
	if($stmt->execute()) {
		header("Location: companies.php");
		exit();
	} else {
		echo "Error";
	}
}
?>
