<?php
session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST)) {
    $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $stream = mysqli_real_escape_string($conn, $_POST['stream']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
    $Hsc = mysqli_real_escape_string($conn, $_POST['hsc']);
    $Ssc = mysqli_real_escape_string($conn, $_POST['ssc']);
    $UG = mysqli_real_escape_string($conn, $_POST['ug']);
    $PG = mysqli_real_escape_string($conn, $_POST['pg']);

    $uploadOk = true;

    if (isset($_FILES)) {
        $folder_dir = "../uploads/resume/";
        $base = basename($_FILES['resume']['name']);
        $resumeFileType = pathinfo($base, PATHINFO_EXTENSION);
        $file = uniqid() . "." . $resumeFileType;
        $filename = $folder_dir . $file;
        if (file_exists($_FILES['resume']['tmp_name'])) {
            if ($resumeFileType == "pdf") {
                if ($_FILES['resume']['size'] < 500000) { // File size is less than 5MB
                    move_uploaded_file($_FILES["resume"]["tmp_name"], $filename);
                } else {
                    $_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
                    header("Location: edit-profile.php");
                    exit();
                }
            } else {
                $_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed";
                header("Location: edit-profile.php");
                exit();
            }
        }
    } else {
        $uploadOk = false;
    }

    $sql = "UPDATE users SET firstname=?, lastname=?, address=?, city=?, state=?, contactno=?, qualification=?, stream=?, skills=?, aboutme=?, Hsc=?, Ssc=?, UG=?, PG=?";
    
    if ($uploadOk == true) {
        $sql .= ", resume=?";
    }

    $sql .= " WHERE id_user=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssi", $firstname, $lastname, $address, $city, $state, $contactno, $qualification, $stream, $skills, $aboutme, $Hsc, $Ssc, $UG, $PG, $_SESSION['id_user']);

    if ($stmt->execute() === TRUE) {
        $_SESSION['name'] = $firstname . ' ' . $lastname;
        header("Location: index.php");
        exit();
    } else {
        echo "Error " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
} else {
    header("Location: edit-profile.php");
    exit();
}
?>
