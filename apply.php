<?php

session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

require_once("db.php");

if (isset($_GET['id'])) {
    $stmt1 = $conn->prepare("SELECT hsc, ssc, ug, pg, qualification FROM users WHERE id_user=?");
    $stmt1->bind_param("i", $_SESSION['id_user']);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $sum = $row1['hsc'] + $row1['ssc'] + $row1['ug'] + $row1['pg'];
        $total = ($sum / 4);
        $user_qualifications = explode("/", $row1['qualification']); // Split qualification into an array
    }

    $stmt2 = $conn->prepare("SELECT eligibility, qualification FROM job_post WHERE id_jobpost=?");
    $stmt2->bind_param("i", $_GET['id']);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $eligibility = $row2['eligibility'];
        $job_qualification = $row2['qualification'];
        $job_qualifications = explode("/", $job_qualification); // Split qualification into an array
        $qualification_matched = false;
        foreach ($job_qualifications as $job_qualification) {
            if (in_array($job_qualification, $user_qualifications)) {
                $qualification_matched = true;
                break;
            }
        }
        if ($row1['ug'] >= $eligibility && $qualification_matched) {
            header("Location: view-job-post.php?id=$_GET[id]");
            $_SESSION['status'] = "You are eligible for this drive.";
            $_SESSION['status_code'] = "success";
            exit();
        }
        $stmt3 = $conn->prepare("SELECT * FROM apply_job_post WHERE id_user=? AND id_jobpost=?");
        $stmt3->bind_param("ii", $_SESSION['id_user'], $_GET['id']);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        if ($result3->num_rows == 0) {
            $stmt4 = $conn->prepare("SELECT C.id_company FROM job_post AS SJ INNER JOIN company AS C ON SJ.id_company=C.id_company WHERE id_jobpost=?");
            $stmt4->bind_param("i", $_GET['id']);
            $stmt4->execute();
            $result4 = $stmt4->get_result();
            $row4 = $result4->fetch_assoc();

            $stmt5 = $conn->prepare("INSERT INTO apply_job_post(id_jobpost, id_company, id_user) VALUES (?, ?, ?)");
            $stmt5->bind_param("iii", $_GET['id'], $row4['id_company'], $_SESSION['id_user']);
            if ($stmt5->execute()) {
                $_SESSION['jobApplySuccess'] = true;
                header("Location: user/index.php");
                $_SESSION['status1'] = "Congrats!";
                $_SESSION['status_code1'] = "success";
                exit();
            } else {
                echo "Error: " . $stmt5->error;
            }
        } else {
            header("Location: view-job-post.php?id=$_GET[id]");
            $_SESSION['status'] = "You have already applied for this Drive.";
            $_SESSION['status_code'] = "success";
            exit();
        }
    }    
} 
else {
    header("Location: user/index.php");
    exit();
}
?>
