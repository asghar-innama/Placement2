<?php

// To Handle Session Variables on This Page
session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

// Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

// If user Actually clicked apply button
if (isset($_GET)) {
    // Prepare statement to select user details
    $sql1 = "SELECT hsc, ssc, ug, pg, qualification FROM users WHERE id_user=?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $_SESSION['id_user']); // Bind the parameter
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $sum = $row1['hsc'] + $row1['ssc'] + $row1['ug'] + $row1['pg'];
        $total = ($sum / 4);
        $user_qualifications = explode("/", $row1['qualification']); // Split qualification into an array
    }

    // Prepare statement to select job post details
    $sql2 = "SELECT eligibility, qualification FROM job_post WHERE id_jobpost=?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $_GET['id']); // Bind the parameter
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $eligibility = $row2['eligibility'];
        $job_qualification = $row2['qualification'];
        $job_qualifications = explode("/", $job_qualification); // Split qualification into an array
        // Check if any of the user's qualifications matches the job qualification
        $qualification_matched = false;
        foreach ($user_qualifications as $user_qualification) {
            if (in_array($user_qualification, $job_qualifications)) {
                $qualification_matched = true;
                break;
            }
        }
        if ($total >= $eligibility && $qualification_matched) {
            // Redirect to view-job-post.php if eligible
            header("Location: view-job-post.php?id=$_GET[id]");
            $_SESSION['status'] = "You are eligible for this drive.";
            $_SESSION['status_code'] = "success";
            exit();
        }
    }

    // Prepare statement to check if user has already applied
    $sql3 = "SELECT * FROM apply_job_post WHERE id_user=? AND id_jobpost=?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("ii", $_SESSION['id_user'], $_GET['id']); // Bind the parameters
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    if ($result3->num_rows == 0) {
        // Prepare statement to insert into apply_job_post table
        $sql4 = "SELECT C.id_company FROM job_post AS SJ INNER JOIN company AS C ON SJ.id_company=C.id_company WHERE id_jobpost=?";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param("i", $_GET['id']); // Bind the parameter
        $stmt4->execute();
        $result4 = $stmt4->get_result();
        $row4 = $result4->fetch_assoc();

        $sql5 = "INSERT INTO apply_job_post(id_jobpost, id_company, id_user) VALUES (?, ?, ?)";
        $stmt5 = $conn->prepare($sql5);
        $stmt5->bind_param("iii", $_GET['id'], $row4['id_company'], $_SESSION['id_user']); // Bind the parameters
        if ($stmt5->execute()) {
            // Redirect to user/index.php if successful
            $_SESSION['jobApplySuccess'] = true;
            header("Location: user/index.php");
            $_SESSION['status1'] = "Congrats!";
            $_SESSION['status_code1'] = "success";
            exit();
        } else {
            echo "Error: " . $stmt5->error;
        }
    } else {
        // Redirect to view-job-post.php if already applied
        header("Location: view-job-post.php?id=$_GET[id]");
        $_SESSION['status'] = "You have already applied for this Drive.";
        $_SESSION['status_code'] = "success";
        exit();
    }
} else {
    header("Location: user/index.php");
    exit();
}
?>
