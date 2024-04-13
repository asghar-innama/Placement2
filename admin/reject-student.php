<?php

session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

if (isset($_GET['id'])) {
    $sql = "UPDATE users SET active='0' WHERE id_user=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $_GET['id']);

        if ($stmt->execute()) {
            header("Location: applications.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "No user ID specified";
}
?>
