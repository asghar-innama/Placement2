<?php
session_start();
require_once("../db.php");
$sql = "SELECT * FROM users";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Fetch the rows as associative array
        while ($row = $result->fetch_assoc()) {
            // Output the value of the 'Name' column for each row
            echo $row['Name'];
        }
    } else {
        echo "No records found";
    }
    // Close the statement
    $stmt->close();
} else {
    // Handle statement preparation error
    echo "Error preparing statement: " . $conn->error;
}
// Close the connection
$conn->close();
?>
