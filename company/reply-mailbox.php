<?php
session_start();
require_once("../db.php");

if(isset($_POST)) {
    $message = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO reply_mailbox (id_mailbox, id_user, usertype, message) VALUES (?, ?, 'company', ?)");
    $stmt->bind_param("iis", $_POST['id_mail'], $_SESSION['id_company'], $message);
    
    if($stmt->execute()) {
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