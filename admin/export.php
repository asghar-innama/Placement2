<?php

session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

// Construct your SQL query here based on your data retrieval logic
$sql = "SELECT firstname, lastname, qualification, stream, passingyear, age, skills, city, state, contactno, email, hsc, ssc, ug, pg, aboutme FROM users";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt) {
    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($firstname, $lastname, $qualification, $stream, $passingyear, $age, $skills, $city, $state, $contactno, $email, $hsc, $ssc, $ug, $pg, $aboutme);

    $html = '<table><tr><td>Student Name</td><td>Highest Qualification</td><td>Stream</td><td>Passing Year</td><td>Age</td><td>Skills</td><td>City</td><td>State</td><td>Contact No.</td><td>Email</td><td>HSC</td><td>SSC</td><td>UG</td><td>PG</td><td>About Me</td></tr>';

    // Fetch the results
    while ($stmt->fetch()) {
        $html .= '<tr><td>' . $firstname . ' ' . $lastname . '</td><td>' . $qualification . '</td><td>' . $stream . '</td><td>' . $passingyear . '</td><td>' . $age . '</td><td>' . $skills . '</td><td>' . $city . '</td><td>' . $state . '</td><td>' . $contactno . '</td><td>' . $email . '</td><td>' . $hsc . '</td><td>' . $ssc . '</td><td>' . $ug . '</td><td>' . $pg . '</td><td>' . $aboutme . '</td></tr>';
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
