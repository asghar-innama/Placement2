<?php

session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

if (isset($_GET['id'])) {
    $sql1 = "SELECT hsc, ssc, ug, pg, qualification FROM users WHERE id_user=?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $_SESSION['id_user']);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $sum = $row1['hsc'] + $row1['ssc'] + $row1['ug'] + $row1['pg'];
        $total = $sum / 4;
        $course1 = $row1['qualification'];
    }

    $sql2 = "SELECT eligibility, qualification FROM job_post WHERE id_jobpost=?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $_GET['id']);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $eligibility = $row2['eligibility'];
        $course2 = $row2['qualification'];
        if ($row1['ug'] >= $eligibility) {
            if ($course1 == $course2) {
                header("Location: ../view-job-post.php?id=$_GET[id]");
                $_SESSION['status'] = "You are eligible for this drive, apply if you are interested.";
                $_SESSION['status_code'] = "success";
                exit();
            } else {
                header("Location: ../view-job-post.php?id=$_GET[id]");
                $_SESSION['status'] = "You are not eligible for this drive due to the course criteria. Check out other drives.";
                $_SESSION['status_code'] = "success";
                exit();
            }
        } else {
            header("Location: ../view-job-post.php?id=$_GET[id]");
            $_SESSION['status'] = "You are not eligible for this drive either due to the overall percentage criteria or course criteria. Update your marks in your profile, if you think you are eligible.";
            $_SESSION['status_code'] = "success";
        }
    }
}
?>
