<?php
session_start();
if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

$sql = "SELECT * FROM apply_job_post WHERE id_company=? AND id_user=? AND id_jobpost=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $_SESSION['id_company'], $_GET['id'], $_GET['id_jobpost']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

// Changing the default status to value 0 to indicate that the student is placed.
$sql = "UPDATE apply_job_post SET status='0' WHERE id_company=? AND id_user=? AND id_jobpost=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $_SESSION['id_company'], $_GET['id'], $_GET['id_jobpost']);
if ($stmt->execute()) {
    header("Location: job-applications.php");
    exit();
}
?>
