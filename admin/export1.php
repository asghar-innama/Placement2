<?php
session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

// Construct your SQL query here based on your data retrieval logic
$sql = "SELECT users.firstname, users.lastname, users.email, job_post.jobtitle, job_post.role, job_post.minimumsalary 
        FROM users 
        INNER JOIN apply_job_post ON users.id_user = apply_job_post.id_user 
        INNER JOIN job_post ON apply_job_post.id_jobpost = job_post.id_jobpost";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt) {
    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($firstname, $lastname, $email, $jobtitle, $role, $minimumsalary);

    // Start HTML output
    $html = '<table><tr><td>Student Name</td><td>Email</td><td>Company Name</td><td>Role</td><td>CTC</td></tr>';

    // Fetch the results and generate table rows
    while ($stmt->fetch()) {
        $html .= '<tr><td>' . $firstname . ' ' . $lastname . '</td><td>' . $email . '</td><td>' . $jobtitle . '</td><td>' . $role . '</td><td>' . $minimumsalary . '</td></tr>';
    }
    $html .= '</table>';

    // Close the statement
    $stmt->close();

    // Set headers to force download as an Excel file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=report.xls');

    // Output the HTML content
    echo $html;
} else {
    // Handle statement preparation error
    echo "Error preparing statement: " . $conn->error;
}

// Close the connection
$conn->close();
?>
