<?php
session_start();

if (empty($_SESSION['id_admin'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

// Prepare statement for selecting job post
$sql1 = "SELECT * FROM job_post WHERE id_jobpost = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("i", $_GET['id']); // Bind the parameter
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows > 0) {
  $row = $result1->fetch_assoc();
}

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
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
        .heading-text {
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        .details{
            font-size: 20px;
            font-weight: bold;
            color:white;
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
            <div class=" col-md-2">

            </div>
            <div class="col-md-8 bg-white padding-2">
              <div class="pull-left">
                <h2><b style = "color:white;"><?php echo $row['jobtitle']; ?></b></h2>
              </div>
              <div class="pull-right">
                <a href="active-jobs.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Back</a>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div>
              <h5 class="details">
                <span class="heading-text"><i class="fa fa-location-arrow text-green"> </i> Role: <?php echo $row['role'] . " &nbsp &nbsp &nbsp &nbsp &nbsp"; ?> </span>
                <span class="heading-text"> <i class="fa fa-money text-green"> </i> CTC:</span> <?php echo "Rs " . $row['minimumsalary'] . " &nbsp &nbsp &nbsp &nbsp   "; ?></span>
                <span class="heading-text"><i class="fa fa-calendar text-green"> </i> Drive Date:</span> <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></span><br><br>
                <span class="heading-text"><i class="fa fa-solid fa-check text-green"></i> Eligibility: </span> <?php echo $row['eligibility']." % aggregate &nbsp &nbsp &nbsp"; ?> </span>
                <span class="heading-text"><i class="fa fa-graduation-cap text-green"></i> Qualification: </span><?php echo $row['qualification'] . "&nbsp &nbsp &nbsp &nbsp"; ?></span>
                <span class="heading-text"> <i class="fa fa-solid fa-check text-green"></i> Min CGPA Required:</span> <?php echo $row['cgpa']; ?></span><br><br>
                <span class="heading-text"><i class="fa fa-solid fa-check text-green"> </i> Max Number of Backlogs Allowed:</span> <?php echo $row['backlogs'] . "&nbsp &nbsp &nbsp &nbsp"; ?></span><br><br>
                <span class="heading-text" style="font-size:18px;"><i class="fa fa-solid fa-check text-green"> </i> Company URL: <?php echo $row['companyurl']; ?></a></span>
            </h5>
              </div>
              <div>
                <?php echo stripcslashes($row['description']); ?>
              </div>
              <div class="pull-right">
                <a style="margin-left:2px" href="updatedrive.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-lef" "></i> Update Drive</a>
                      </div>

            </div>
            <div class=" col-md-2">

              </div>
            </div>
          </div>
      </section>
      <?php
      $_SESSION['id_jobpost'] = $row['id_jobpost'];
      ?>
    </div>
    <!--content-wrapper -->

    <footer class="main-footer" style="margin-left: 0px;">
    </footer>

    <!-- /.control-sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>
</body>
</html>
