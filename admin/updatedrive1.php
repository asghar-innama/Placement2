<?php
session_start();

if (empty($_SESSION['id_jobpost'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST['submit'])) {
    // Prepare and bind SQL statement with prepared statement
    $sql = "UPDATE job_post SET jobtitle=?, role=?, minimumsalary=?, qualification=?, eligibility=?, description=?, cgpa=?, backlogs=? WHERE id_jobpost=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssssii", $companyname, $role, $CTC, $qualification, $Eligibility, $description, $cgpa, $backlogs, $_SESSION['id_jobpost']);

    $companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $CTC = mysqli_real_escape_string($conn, $_POST['CTC']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $Eligibility = mysqli_real_escape_string($conn, $_POST['Eligibility']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
<<<<<<< Updated upstream
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $backlogs = mysqli_real_escape_string($conn, $_POST['backlogs']);

    if ($stmt->execute()) {
        header("Location: active-jobs.php?success=1");
=======
    $url = mysqli_real_escape_string($conn, $_POST['companyurl']);
    $backlogs = mysqli_real_escape_string($conn, $_POST['backlogs']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);


    $sql = "UPDATE job_post SET jobtitle='$companyname', role='$role', minimumsalary='$CTC', qualification='$qualification', eligibility='$Eligibility',  description='$description', backlogs='$backlogs', cgpa='$cgpa', companyurl='$url' where id_jobpost='$_SESSION[id_jobpost] '";

    if ($conn->query($sql) === TRUE) {
        // $_SESSION['name'] = $companyname;
        //If data Updated successfully then redirect to dashboard
        header("Location: active-jobs.php");
>>>>>>> Stashed changes
        exit();
    } else {
        header("Location: active-jobs.php?error=" . urlencode($conn->error));
        exit();
    }
} else {
    header("Location: active-jobs.php");
    exit();
}
