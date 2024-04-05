<?php

session_start();

if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST['jobtitle'])) {
    // New way using prepared statements to prevent SQL Ijection attacks
    $stmt = $conn->prepare("INSERT INTO job_post (jobtitle, minimumsalary, eligibility, role, qualification, backlogs, cgpa, companyurl, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Fixing the first parameter of bind_param() to match the number of placeholders
    $stmt->bind_param('sdsssisss', $jobtitle, $minimumsalary, $eligibility, $role, $qualification, $backlogs, $cgpa, $companyurl, $description);

    // Escape the variables before binding them
    $jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
    $minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
    $eligibility = mysqli_real_escape_string($conn, $_POST['eligibility']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $backlogs = mysqli_real_escape_string($conn, $_POST['backlogs']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $companyurl = mysqli_real_escape_string($conn, $_POST['companyurl']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if ($stmt->execute()) {
        $_SESSION['jobPostSuccess'] = true;
        include 'sendmail.php';
        header("Location: index.php");
        exit();
    } else {
        echo "Error ";
    }
    $stmt->close();

    // Close database connection
    $conn->close();
} else {
    header("Location: create-job-post.php");
    exit();
}
?>
