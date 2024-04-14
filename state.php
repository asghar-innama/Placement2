<?php
session_start();
require_once("db.php");

if(isset($_POST)) {

	$sql = "SELECT * FROM states WHERE country_id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_POST['id']);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["name"].'" data-id="'.$row["id"].'">'.$row["name"].'</option>';
			}		
	}
 	$conn->close();
} 
?>
