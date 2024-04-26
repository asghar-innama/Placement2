<?php
session_start();
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}
require_once("../db.php");

if(isset($_POST)) {
    $password = $_POST['password'];
    $password = base64_encode(strrev(md5($password)));
    $sql = "UPDATE company SET password=? WHERE id_company=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $password, $_SESSION['id_company']);
    if($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo $conn->error;
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: settings.php");
    exit();
}
?>
