<?php
session_start();
if (empty($_SESSION['id_company'])) {
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

    include 'header.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
          <div class="col-md-3">
              <div class="box box-solid">
              <div class="box-header with-border">
                <div style="text-align: center;">
                  <img src="christlogo2.png" alt="Logo1" style="width: 200px; float: right;">
               </div>
              </div>
                <div class="box-header with-border">
                    <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li ><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="edit-company.php"><i class="fa fa-tv"></i> Update Profile</a></li>
                    <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Post Drive</a></li>
                    <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> Current Drives</a></li>
                    <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Drive Applications</a></li>
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li class="active"><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">
              <h4><i>Account Settings</i></h4>
              <p>In this section you can change your name and account password</p>
              <div class="row">
                <div class="col-md-6">
                  <form action="update-name.php" method="post">
                    <div class="form-group">
                      <label>Your Name (Full Name)</label>
                      <input class="form-control input-lg" name="name" type="text">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-flat btn-primary btn-lg">Change Name</button>
                    </div>
                  </form>
                  <form id="changePassword" action="change-password.php" method="post">
                    <div class="form-group">
                      <input id="password" class="form-control input-lg" type="password" name="password" autocomplete="off" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <input id="cpassword" class="form-control input-lg" type="password" autocomplete="off" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-flat btn-success btn-lg">Change Password</button>
                    </div>
                    <div id="passwordError" class="color-red text-center hide-me">
                      Password Mismatch!!
                    </div>
                  </form>
                  <form action="deactivate-account.php" method="post">
                    <label><input type="checkbox" required> I Want To Deactivate My Account</label>
                    <button class="btn btn-danger btn-flat btn-lg">Deactivate My Account</button>
                  </form>
                </div>
              </div>
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
  <script>
    $("#changePassword").on("submit", function(e) {
      e.preventDefault();
      if ($('#password').val() != $('#cpassword').val()) {
        $('#passwordError').show();
      } else {
        $(this).unbind('submit').submit();
      }
    });
  </script>
</body>

</html>
