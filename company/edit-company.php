<?php
//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
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
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
    }

    .profile-form {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
    }

    .profile-form h2 {
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 24px;
      color: black;
    }

    .profile-form .form-group {
      margin-bottom: 20px;
    }

    .profile-form label {
      font-weight: bold;
      font-size: 14px;
      color: black;
    }

    .profile-form input[type="text"],
    .profile-form input[type="email"],
    .profile-form textarea {
      width: 100%;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 20px;
      box-sizing: border-box;
      font-size: 16px;
      margin-top: 5px;
      transition: border-color 0.3s;
    }

    .profile-form textarea {
      resize: vertical;
      min-height: 150px;
    }

    .profile-form input[type="text"]:focus,
.profile-form input[type="email"]:focus,
.profile-form textarea:focus {
  border-color: #45a049;
  border-width: 3px; /* Increase border thickness */
}

    .profile-form button {
  width: 25%;
  margin: 0 auto; /* Center the button horizontally */
  display: block; /* Ensure the button takes full width */
  padding: 15px;
  background-color: #8B0000;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s;
}


    .profile-form button:hover {
      background-color: #45a049;
    }
  </style>
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
                  <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><a href="edit-company.php"><i class="fa fa-tv"></i> Update Profile</a></li>
                    <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Post Drive</a></li>
                    <li><a href="my-job-post.php"><i class="fa fa-file-o"></i> Current Drives</a></li>
                    <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Drive Applications</a></li>
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">
              <div class="profile-form">
                <h2><i>Placement-Official Profile</i></h2>
                <div class="row">
                  <form action="update-company.php" method="post" enctype="multipart/form-data">
                    <?php
                    $sql = "SELECT * FROM company WHERE id_company='$_SESSION[id_company]'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="companyname">Name</label>
                            <input type="text" class="form-control" name="companyname" value="<?php echo $row['companyname']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" value="<?php echo $row['website']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="aboutme">About Me</label>
                            <textarea class="form-control" name="aboutme" rows="4"><?php echo $row['aboutme']; ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="contactno">Contact Number</label>
                            <input type="text" class="form-control" name="contactno" value="<?php echo $row['contactno']; ?>">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" value="<?php echo $row['state']; ?>">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="logo">Insert your Profile image </label>
                            <input type="file" name="logo" class="form-control">
                          </div>
                          <?php if ($row['logo'] != "") { ?>
                            <img src="../uploads/logo/<?php echo $row['logo']; ?>" class="img-responsive" style="max-height: 200px; max-width: 200px;">
                          <?php } ?>
                        </div>
                    <?php
                      }
                    }
                    ?>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-success btn-lg">Update Profile</button>
                    </div>
                  </form>
                </div>
                <?php if (isset($_SESSION['uploadError'])) { ?>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <?php echo $_SESSION['uploadError']; ?>
                    </div>
                  </div>
                <?php unset($_SESSION['uploadError']);
                } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="margin-left: 0px;">
    </footer>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>
</body>

</html>
