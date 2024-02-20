<?php

// To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="../css/style.css">
    <title>Placement Portal</title>
</head>

<body>
<?php
    include 'header.php';
?>
    <div class="container" id="cv-form">
        <h1 class="text-center my-3">Resume Generator</h1>
        <div class="text-right ">


            <br>
            <br>


            <div class="row">


                <div class="col md-6">
                    <h3>Personal Information</h3>
                    <div class="form-group">

                        <label for="namefield">Your Name</label>
                        <input type="text" id="nameField" placeholder=" Enter here" class=" form-control">

                    </div>
                    <div class="form-group mt-2">

                        <label for="contactfield">Your Contact</label>
                        <input type="text" id="contactField" placeholder=" Enter here" class=" form-control">

                    </div>
                    <div class="form-group mt-2">

                        <label for="addressfield">Your Address</label>
                        <textarea type="text" id="addressField" placeholder=" Enter here" class=" form-control" rows="5"></textarea>

                    </div>

                    <div class="form-group mt-3">
                        <label for="">Select Your Photo</label>
                        <input type="file" onchange="previewFile()" id="imageField" class="form-control">
                        <img id="img8" src="" height="200" alt="Image preview...">


                    </div>
                    <p class="text-secondary mt-2">Important Links</p>
                    <div class="form-group mt-2">

                        <label for="emailfield"><i class="fa fa-facebook" aria-hidden="true">Email</i></label>
                        <input type="text" id="emailField" placeholder=" Enter here" class=" form-control">

                        </di <div class="form-group mt-2">

                        <label for="fbfield"><i class="fa fa-facebook" aria-hidden="true">Facebook</i></label>
                        <input type="text" id="fbField" placeholder=" Enter here" class=" form-control">

                    </div>
                    <div class="form-group mt-2">

                        <label for="instafield"><i class="fa fa-instagram" aria-hidden="true">Instagram</i></label>
                        <input type="text" id="instaField" placeholder=" Enter here" class=" form-control">

                    </div>
                    <div class="form-group mt-2">

                        <label for="linkedField"><i class="fa fa-linkedin" aria-hidden="true">Linkedin</i></label>
                        <input type="text" id="linkedField" placeholder=" Enter here" class=" form-control">

                    </div>
                </div>
                <div class="col md-6">
                    <h3>Professional Information</h3>
                    <div class="form-group mt-2">

                        <label for="addressfield">Objective</label>
                        <textarea type="text" id="objectiveField" placeholder=" Enter here" rows="1" class=" form-control"></textarea>
                    </div>
                    <div class="form-group mt-2 " id="sF">

                        <label for="">Skills</label>
                        <textarea type="text" placeholder=" Enter here" rows="3" class=" form-control sField"></textarea>

                        <!-- new -textarea will be added here dynamically -->


                        <div class="container mt-2 text-center " id="sAddButton">
                            <button onclick="addNewSfield()" class="btn btn-primary btn-small">Add</button>
                        </div>
                    </div>
                    <div class="form-group mt-2 " id="we">

                        <label for="">Work Experience</label>
                        <textarea type="text" placeholder=" Enter here" rows="3" class=" form-control weField"></textarea>

                        <!-- new -textarea will be added here dynamically -->


                        <div class="container mt-2 text-center " id="weaddButton">
                            <button onclick="addNewWEfield()" class="btn btn-primary btn-small">Add</button>
                        </div>
                    </div>

                    <div class="form-group mt-2" id="eq">

                        <label for="">Academic Qualification</label>
                        <textarea type="text" placeholder=" Enter here" rows="3" class=" form-control eqfield"></textarea>

                        <div class="container mt-2 text-center " id="eqaddButton">
                            <button onclick="addNewEQfield()" class="btn btn-primary btn-small">Add</button>
                        </div>
                    </div>

                </div>


            </div>

            <div class="container text-center mt-3 mb-5">
                <button onclick="generateCV()" class=" btn btn-primary btn-lg">Generate CV</button>
            </div>
        </div>
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script src="../js/script.js"></script>
</body>

</html>