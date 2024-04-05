<?php
session_start();

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
    <style>
        /* Replicated styles from the first form */
        body 
        {
            font-family: sans-serif;
        }

        .container {
            margin: auto;
            margin-bottom: 10px;
            text-align: center;
        }

        h1 {
        font-size: 30px; /* Increase font size */
        margin-bottom: 10px; /* Add some bottom margin for spacing */
        color: #8B0000;
        font-family: "Times New Roman", Times, serif;
        font-weight: bold;
        /*text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);  Add a subtle text-shadow for emphasis */
        /* You can also add more styling such as color, font-family, etc. */
        }

        h3 {
            font-family: "Times New Roman", Times, serif;
            font-weight: bold;
            text-decoration: underline; /* Add underline */
            color: black;
            font-size: 20px;
            /* You can also add more styling such as text-shadow */
            }

        label 
        {
            font-family: "Times New Roman", Times, serif;
            /* font-weight: bold;  Add font-weight for emphasis */
             /* text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); Add a subtle text-shadow */
            color: black;
            font-size: 15px;
            /* You can also add more styling such as color, font-size, etc. */
        }


        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
            background-color: #8B0000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #8B0000;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-info {
            background-color: #d9edf7;
            border-color: #bce8f1;
            color: #31708f;
        }

        .alert-info strong {
            color: #245269;
        }
    </style>
    <title>Placement Portal</title>
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

        <?php include 'header.php'?>

        <div class="container" id="cv-form">
            <br>
            <h1 class="text-center my-3">Resume Generator</h1>
            <div class="text-right ">
                <br>
                <br>
                <div class="row">
                    <div class="col md-6">
                        <h3>Personal Information</h3>
                        <div class="form-group">
                            <label for="namefield">Your Name</label>
                            <input type="text" id="nameField" placeholder="Enter here" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="contactfield">Your Contact</label>
                            <input type="text" id="contactField" placeholder="Enter here" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="addressfield">Your Address</label>
                            <textarea type="text" id="addressField" placeholder="Enter here" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Select Your Photo</label>
                            <input type="file" onchange="previewFile()" id="imageField" class="form-control">
                            <img id="img8" src="" height="200" alt="Image preview...">
                        </div>
                        <p class="text-secondary mt-2">Important Links</p>
                        <div class="form-group mt-2">
                            <label for="emailfield"><i class="fa fa-facebook" aria-hidden="true">Email</i></label>
                            <input type="text" id="emailField" placeholder="Enter here" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="fbfield"><i class="fa fa-facebook" aria-hidden="true">Facebook</i></label>
                            <input type="text" id="fbField" placeholder="Enter here" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="instafield"><i class="fa fa-instagram" aria-hidden="true">Instagram</i></label>
                            <input type="text" id="instaField" placeholder="Enter here" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="linkedField"><i class="fa fa-linkedin" aria-hidden="true">Linkedin</i></label>
                            <input type="text" id="linkedField" placeholder="Enter here" class="form-control">
                        </div>
                    </div>
                    <div class="col md-6">
                        <h3>Professional Information</h3>
                        <div class="form-group mt-2">
                            <label for="addressfield">Objective</label>
                            <textarea type="text" id="objectiveField" placeholder="Enter here" rows="1" class="form-control"></textarea>
                        </div>
                        <div class="form-group mt-2 " id="sF">
                            <label for="">Skills</label>
                            <textarea type="text" placeholder="Enter here" rows="3" class="form-control sField"></textarea>
                            <div class="container mt-2 text-center " id="sAddButton">
                                <button onclick="addNewSfield()" class="btn btn-primary btn-small">Add</button>
                            </div>
                        </div>
                        <div class="form-group mt-2 " id="we">
                            <label for="">Work Experience</label>
                            <textarea type="text" placeholder="Enter here" rows="3" class="form-control weField"></textarea>
                            <div class="container mt-2 text-center " id="weaddButton">
                                <button onclick="addNewWEfield()" class="btn btn-primary btn-small">Add</button>
                            </div>
                        </div>
                        <div class="form-group mt-2" id="eq">
                            <label for="">Academic Qualification</label>
                            <textarea type="text" placeholder="Enter here" rows="3" class="form-control eqfield"></textarea>
                            <div class="container mt-2 text-center " id="eqaddButton">
                                <button onclick="addNewEQfield()" class="btn btn-primary btn-small">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container text-center mt-3 mb-5">
                <button onclick="generatePDF()" class="btn btn-primary">Generate PDF</button>
                </div>
            </div>
        </div>

    </div>
    <div class="container mb-4" id="cv-template">
        <div class="row">
            <div class="col-md-4 text-center py-5 background">
                <img id="imgT" src="https://st.depositphotos.com/2101611/3925/v/600/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" class="img-fluid my-img" alt="">
                <div class="container">
                    <p id="nameT1"><strong>Joanna Varkey</strong></p>
                    <p id="contactT">8541122525</p>
                    <p id="addressT">City, India</p>
                    <hr />
                    <p><a id="emailT" href="#">Email</a></p>
                    <p><a id="fbT" href="#">www.facebook.com</a></p>
                    <p><a id="instaT" href="#">www.instagram.com</a></p>
                    <p><a id="linkedT" href="#">www.linkedin.com</a></p>
                </div>
            </div>
            <div class="col-md-8 py-5">
                <h1 id="nameT2">Joanna Varkey/h1>
                <div class="card mt-4">
                    <div class="card-header background">
                        <h4>Objective</h4>
                    </div>
                    <div class="card-body">
                        <p id="objectiveT">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, alias! Impedit
                            totam fugiat
                            accusamus maxime, hic earum alias molestiae! Numquam.</p>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header background">
                        <h4>Skills</h4>
                    </div>
                    <div class="card-body">
                        <ul id="sT">
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header background">
                        <h4>Work Experience</h4>
                    </div>
                    <div class="card-body">
                        <ul id="weT">
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header background">
                        <h4>Education Qualification</h4>
                    </div>
                    <div class="card-body">
                        <ul id="eqT">
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, maiores!</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container mt-3 text-center">
                <button onclick="printCV()" class="btn btn-primary">Print CV</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</body>

</html>
