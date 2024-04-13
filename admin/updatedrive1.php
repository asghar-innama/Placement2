<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
if (empty($_SESSION['id_jobpost'])) {
    header("Location: index.php");
    exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files  
require_once("../db.php");

if (isset($_POST['submit'])) {
    // Prepare and bind SQL statement with prepared statement
    $sql = "UPDATE job_post SET jobtitle=?, role=?, minimumsalary=?, qualification=?, eligibility=?, description=?, cgpa=?, backlogs=? WHERE id_jobpost=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssssii", $companyname, $role, $CTC, $qualification, $Eligibility, $description, $cgpa, $backlogs, $_SESSION['id_jobpost']);

    // Escape user inputs for security (optional if using prepared statements)
    $companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $CTC = mysqli_real_escape_string($conn, $_POST['CTC']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $Eligibility = mysqli_real_escape_string($conn, $_POST['Eligibility']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
    $backlogs = mysqli_real_escape_string($conn, $_POST['backlogs']);

    // Execute the update statement
    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: active-jobs.php?success=1");
        exit();
    } else {
        // Redirect with error message
        header("Location: active-jobs.php?error=" . urlencode($conn->error));
        exit();
    }
} else {
    // Redirect back if form not submitted
    header("Location: active-jobs.php");
    exit();
}
