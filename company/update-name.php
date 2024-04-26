<?php
session_start();
if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}
require_once("../db.php");

// If user Actually clicked login button
if (isset($_POST)) {

    // Escape Special Characters in String
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql = "UPDATE company SET name=? WHERE id_company=?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $name, $_SESSION['id_company']);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
} else {
    // Redirect them back to login page if they didn't click login button
    header("Location: settings.php");
    exit();
}
?>
