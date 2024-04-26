<?php
session_start();
if (empty($_SESSION['id_jobpost'])) {
    header("Location: ../index.php");
    exit();
}
require_once("../db.php");

if (isset($_POST['submit'])) {
    $companyname = $_POST['companyname'];
    $role = $_POST['role'];
    $CTC = $_POST['CTC'];
    $qualification = $_POST['qualification'];
    $Eligibility = $_POST['Eligibility'];
    $description = $_POST['description'];
    $url = $_POST['companyurl'];
    $cgpa = $_POST['cgpa'];
    $backlogs = $_POST['backlogs'];

    $stmt = $conn->prepare("UPDATE job_post SET jobtitle=?, role=?, minimumsalary=?, eligibility=?, qualification=?, description=?, companyurl=?, cgpa=?, backlogs=? WHERE id_jobpost=?");
    $stmt->bind_param("ssisssssii", $companyname, $role, $CTC, $Eligibility, $qualification, $description, $url, $cgpa, $backlogs, $_SESSION['id_jobpost']);

    if ($stmt->execute()) {
        // Redirect to dashboard if data updated successfully
        header("Location: my-job-post.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: updatedrive.php");
    exit();
}
?>
