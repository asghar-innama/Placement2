<?php
session_start();
require_once("db.php");

// If user Actually clicked login button 
if (isset($_POST)) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = base64_encode(strrev(md5($password)));

    $sql = "SELECT id_user, firstname, lastname, email, active FROM users WHERE email=? AND password=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Output data
        while ($row = $result->fetch_assoc()) {
            if ($row['active'] == '0') {
                $_SESSION['loginActiveError'] = "Your Account Is Not Active. Check Your Email.";
                header("Location: index.php");
                exit();
            } else if ($row['active'] == '1') {
                // Set some session variables for easy reference
                $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
                $_SESSION['id_user'] = $row['id_user'];

                if (isset($_SESSION['callFrom'])) {
                    $location = $_SESSION['callFrom'];
                    unset($_SESSION['callFrom']);

                    header("Location: " . $location);
                    exit();
                } else {
                    header("Location: user/index.php");
                    exit();
                }
            } else if ($row['active'] == '2') {
                $_SESSION['loginActiveError'] = "Your Account Is Deactivated. Contact Admin To Reactivate.";
                header("Location: index.php");
                exit();
            }
        }
    } else {
        // If no matching record found in user table then redirect them back to login page
        $_SESSION['loginError'] = "Invalid email or password";
        header("Location: login-candidates.php");
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    // Redirect them back to login page if they didn't click login button
    header("Location: login-candidates.php");
    exit();
}
?>
