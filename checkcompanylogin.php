<?php
session_start();
require_once("db.php");

// If user Actually clicked login button 
if (isset($_POST)) {
    $sql = "SELECT id_company, companyname, email, active FROM company WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    // Escape Special Characters in String
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = base64_encode(strrev(md5($password)));

	$stmt->execute();
    $result = $stmt->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Output data
        while ($row = $result->fetch_assoc()) {
            if ($row['active'] == '2') {
                $_SESSION['companyLoginError'] = "Your Account Is Still Pending Approval.";
                header("Location: login-company.php");
                exit();
            } else if ($row['active'] == '0') {
                $_SESSION['companyLoginError'] = "Your Account Is Rejected. Please Contact For More Info.";
                header("Location: login-company.php");
                exit();
            } else if ($row['active'] == '1') {
                // active 1 means admin has approved account.
                // Set some session variables for easy reference
                $_SESSION['name'] = $row['companyname'];
                $_SESSION['id_company'] = $row['id_company'];

                // Redirect them to company dashboard once logged in successfully
                header("Location: company/index.php");
                exit();
            } else if ($row['active'] == '3') {
                $_SESSION['companyLoginError'] = "Your Account Is Deactivated. Contact Admin For Reactivation.";
                header("Location: login-company.php");
                exit();
            }
        }
    } else {
        // If no matching record found in user table then redirect them back to login page
        $_SESSION['loginError'] = "Invalid email or password";
        header("Location: login-company.php");
        exit();
    }
    $stmt->close();
    $conn->close();
} else {
    // Redirect them back to login page if they didn't click login button
    header("Location: login-company.php");
    exit();
}
?>
