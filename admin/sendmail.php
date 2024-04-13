<?php
session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

$sql = "SELECT firstname, lastname, email FROM users WHERE active = 1";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname, $email);

    // Loop through each user
    while ($stmt->fetch()) {
        // Compose the email
        $subject = "New Notice has been posted.";
        $message = "Dear $firstname $lastname,\n\n";
        $message .= "The TPO has posted a new notice on the placement portal. ";
        $message .= "Please log in to your profile on the placement portal to check the notice.\n\n";
        $message .= "Regards,\nPlacement Cell";

        mail($email, $subject, $message);
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}
ini_set("SMTP", "your_smtp_server");
ini_set("smtp_port", "25");
ini_set("sendmail_from", "your_email_address");
$conn->close();
?>
