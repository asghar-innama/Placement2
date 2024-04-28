<?php
session_start();
if (empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Placement Portal</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <?php
    include 'header.php'
    ?>
    <div class="content-wrapper" style="margin-left: 0px;">
      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
              <div class="box-header with-border">
                <div style="text-align: center;">
                  <img src="christlogo2.png" alt="Logo" style="width: 200px; float: right;">
               </div>
              </div>
                <div class="box-header with-border">
                  <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                    <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">
              <h4>Edit Profile</h4>
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-info"></i><strong>Important</strong><br>All the details provided by you must be absolutely correct and genuine, if found incorrect during further verification, then your candidature might get dismissed from the entire placement process.
              </div>
              <form action="update-profile.php" method="post" enctype="multipart/form-data">
              <?php
                $stmt = $conn->prepare("SELECT * FROM users WHERE id_user=?");
                $stmt->bind_param("i", $_SESSION['id_user']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="row">
                      <div class="col-md-6 latest-job ">
                        <div class="form-group">
                          <label for="fname">First Name</label>
                          <input type="text" class="form-control input-lg" id="fname" name="fname" placeholder="First Name" value="<?php echo $row['firstname']; ?>" required="">
                        </div>
                        <div class="form-group">
                          <label for="lname">Last Name</label>
                          <input type="text" class="form-control input-lg" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row['lastname']; ?>" required="">
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input type="email" class="form-control input-lg" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="address">Address</label>
                          <textarea id="address" name="address" class="form-control input-lg" rows="5" placeholder="Address"><?php echo $row['address']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" class="form-control input-lg" id="city" name="city" value="<?php echo $row['city']; ?>" placeholder="city">
                        </div>
                        <div class="form-group">
                          <label for="state">State</label>
                          <input type="text" class="form-control input-lg" id="state" name="state" placeholder="state" value="<?php echo $row['state']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Marks">HSC Marks</label>
                          <input type="text" class="form-control input-lg" id="Marks" name="hsc" placeholder="Percentage/CGPA" value="<?php echo $row['hsc']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Marks">SSC Marks</label>
                          <input type="text" class="form-control input-lg" id="Marks" name="ssc" placeholder="Percentage/CGPA" value="<?php echo $row['ssc']; ?>">
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-flat btn-success">Update Profile</button>
                        </div>
                      </div>
                      <div class="col-md-6 latest-job ">
                        <div class="form-group">
                          <label for="contactno">Contact Number</label>
                          <input type="text" class="form-control input-lg" id="contactno" name="contactno" placeholder="Contact Number" value="<?php echo $row['contactno']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="qualification">Highest Qualification</label>
                          <input type="text" class="form-control input-lg" id="qualification" name="qualification" placeholder="Highest Qualification" value="<?php echo $row['qualification']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="stream">Stream</label>
                          <input type="text" class="form-control input-lg" id="stream" name="stream" placeholder="stream" value="<?php echo $row['stream']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Skills</label>
                          <textarea class="form-control input-lg" rows="4" name="skills"><?php echo $row['skills']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>About Me</label>
                          <textarea class="form-control input-lg" rows="4" name="aboutme"><?php echo $row['aboutme']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="Marks">UG Marks</label>
                          <input type="text" class="form-control input-lg" id="Marks" name="ug" placeholder="Percentage/CGPA" value="<?php echo $row['ug']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="Marks">PG Marks</label>
                          <input type="text" class="form-control input-lg" id="Marks" name="pg" placeholder="Percentage/CGPA" value="<?php echo $row['pg']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Upload/Change Resume</label>
                          <input type="file" name="resume" class="btn btn-default">
                        </div>

                      </div>
                    </div>
                <?php
                  }
                }
                ?>
              </form>
              <?php if (isset($_SESSION['uploadError'])) { ?>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <?php echo $_SESSION['uploadError']; ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer" style="margin-left: 0px;">
    </footer>
    <div class="control-sidebar-bg"></div>

  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/adminlte.min.js"></script>
</body>
</html>

<style>
  .box {

    font-size: medium;
    font-family: sans-serif;
  }
  li {
    color: aqua;
  }
  @media only screen and (max-width: 989px) {
    .box {
      margin: auto;
      text-align: center;
    }
  }
</style>