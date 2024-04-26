<?php
session_start();
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}
require_once("../db.php");
$stmt = $conn->prepare("SELECT * FROM apply_job_post WHERE id_company=? AND id_user=? AND id_jobpost=?");
$stmt->bind_param("iii", $_SESSION['id_company'], $_GET['id'], $_GET['id_jobpost']);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
  header("Location: index.php");
  exit();
}
$stmt->close();
$stmt = $conn->prepare("UPDATE apply_job_post SET status='1' WHERE id_company=? AND id_user=? AND id_jobpost=?");
$stmt->bind_param("iii", $_SESSION['id_company'], $_GET['id'], $_GET['id_jobpost']);
$stmt->execute();
header("Location: job-applications.php");
exit();
?>