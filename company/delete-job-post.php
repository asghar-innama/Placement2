<?php

session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: index.php");
  exit();
}

require_once("../db.php");

if(isset($_GET['id'])) {
	$sql = "DELETE FROM job_post WHERE id_jobpost=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_GET['id']);
	if($stmt->execute()) {
		$sql1 = "DELETE FROM apply_job_post WHERE id_jobpost=?";
		$stmt1 = $conn->prepare($sql1);
		$stmt1->bind_param("i", $_GET['id']);
		if($stmt1->execute()) {
			echo "Job is deleted";
		}
		header("Location: my-job-post.php");
		exit();
	} else {
		echo "Error";
	}
}
?>
