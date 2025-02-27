<?php
session_start();
if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}
require_once("../db.php");

if (isset($_POST)) {
    $message = mysqli_real_escape_string($conn, $_POST['description']);
    $sql = "INSERT INTO reply_mailbox (id_mailbox, id_user, usertype, message) VALUES (?, ?, 'user', ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $_POST['id_mail'], $_SESSION['id_user'], $message);

    if ($stmt->execute() === TRUE) {
        header("Location: read-mail.php?id_mail=" . $_POST['id_mail']);
        exit();
    } else {
        echo $conn->error;
    }
} else {
    header("Location: mailbox.php");
    exit();
}
?>