<?php
session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}
require_once("../db.php");

if(isset($_POST)) {
    $to = $_POST['to'];
    $sql = "INSERT INTO mailbox (id_fromuser, fromuser, id_touser, subject, message) VALUES (?, 'company', ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $_SESSION['id_company'], $to, $subject, $message);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['description']);

    if($stmt->execute()) {
        header("Location: mailbox.php");
        exit();
    } else {
        echo $conn->error;
    }
    $stmt->close();
} else {
    header("Location: mailbox.php");
    exit();
}
?>
