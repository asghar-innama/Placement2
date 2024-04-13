<?php
session_start();
require_once("../db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

    //Prepare and bind SQL statement with prepared statement
    $sql = "SELECT id_admin FROM admin WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    //Escape Special Characters in String
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //Execute the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();

    //Check if user table has this login details
    if($result->num_rows > 0) {
        //output data
        while($row = $result->fetch_assoc()) {
            
            //Set some session variables for easy reference
            $_SESSION['id_admin'] = $row['id_admin'];
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $_SESSION['loginError'] = true;
        header("Location: index.php");
        exit();
    }

    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
