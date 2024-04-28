<?php

session_start();

if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");

if (isset($_POST)) {
    $sql = "UPDATE users SET active='2' WHERE id_user=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['id_user']);

    if ($stmt->execute()) {
        header("Location: ../logout.php");
        exit();
    } else {
        echo $conn->error;
    }
} else {
    header("Location: settings.php");
    exit();
}
?>
