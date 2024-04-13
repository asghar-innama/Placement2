<?php
session_start();
require_once("db.php");

// If user clicked register button
if(isset($_POST)) {

    // Prepare and bind parameters
    $stmt = $conn->prepare("SELECT email FROM company WHERE email=?");
    $stmt->bind_param("s", $email);

    // Escape Special Characters In String First
    $companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
    $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);

    $aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Encrypt Password
    $password = base64_encode(strrev(md5($password)));

    // Set parameters and execute statement
    $stmt->execute();
    $stmt->store_result();

    // If email not found then we can insert new data
    if($stmt->num_rows == 0) {

        // This variable is used to catch errors doing upload process. False means there is some error and we need to notify that user.
        $uploadOk = true;

        // Folder where you want to save your image. THIS FOLDER MUST BE CREATED BEFORE TRYING
        $folder_dir = "uploads/logo/";

        // Getting Basename of file. So if your file location is Documents/New Folder/myResume.pdf then base name will return myResume.pdf
        $base = basename($_FILES['image']['name']); 

        // This will get us extension of your file. So myimage.pdf will return pdf. If it was image.doc then this will return doc.
        $imageFileType = pathinfo($base, PATHINFO_EXTENSION); 

        // Setting a random non repeatable file name. Uniqid will create a unique name based on current timestamp. We are using this because no two files can be of same name as it will overwrite.
        $file = uniqid() . "." . $imageFileType; 
      
        // This is where your files will be saved so in this case it will be uploads/image/newfilename
        $filename = $folder_dir .$file;  

        // We check if file is saved to our temp location or not.
        if(file_exists($_FILES['image']['tmp_name'])) { 

            // Next we need to check if file type is of our allowed extension or not. I have only allowed pdf. You can allow doc, jpg etc. 
            if($imageFileType == "jpg" || $imageFileType == "png")  {

                // Next we need to check file size with our limit size. I have set the limit size to 5MB. Note if you set higher than 2MB then you must change your php.ini configuration and change upload_max_filesize and restart your server
                if($_FILES['image']['size'] < 500000) { // File size is less than 5MB

                    // If all above condition are met then copy file from server temp location to uploads folder.
                    move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

                } else {
                    // Size Error
                    $_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
                    $uploadOk = false;
                }
            } else {
                // Format Error
                $_SESSION['uploadError'] = "Wrong Format. Only jpg & png Allowed";
                $uploadOk = false;
            }
        } else {
                // File not copied to temp location error.
                $_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
                $uploadOk = false;
            }

        // If there is any error then redirect back.
        if($uploadOk == false) {
            header("Location: register-company.php");
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO company(name, companyname, country, state, city, contactno, website, email, password, aboutme, logo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $name, $companyname, $country, $state, $city, $contactno, $website, $email, $password, $aboutme, $file);

        if($stmt->execute()) {

            // If data inserted successfully then Set some session variables for easy reference and redirect to company login
            $_SESSION['registerCompleted'] = true;
            header("Location: login-company.php");
            exit();

        } else {
            // If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
            echo "Error " . $stmt->error;
        }
    } else {
        // If email found in database then show email already exists error.
        $_SESSION['registerError'] = true;
        header("Location: register-company.php");
        exit();
    }

    // Close statement
    $stmt->close();

    // Close database connection. Not compulsory but good practice.
    $conn->close();

} else {
    // Redirect them back to register page if they didn't click register button
    header("Location: register-company.php");
    exit();
}
?>
