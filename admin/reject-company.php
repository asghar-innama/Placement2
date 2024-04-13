<?php

session_start();

if(empty($_SESSION['id_admin'])) {
	header("Location: index.php");
	exit();
}

require_once("../db.php");

if(isset($_GET['id'])) {
	$sql = "UPDATE company SET active='0' WHERE id_company=?";
	$stmt = $conn->prepare($sql);

	if($stmt) {
		$stmt->bind_param("i", $_GET['id']);

		if($stmt->execute()) {
			header("Location: companies.php");
			exit();
		} else {
			echo "Error executing statement: " . $stmt->error;
		}
		$stmt->close();
	} else {
		echo "Error preparing statement: " . $conn->error;
	}
} else {
	echo "No company ID specified";
}
?>
