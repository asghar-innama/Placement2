<?php

session_start();

if (empty($_SESSION['id_admin'])) {
  header("Location: index.php");
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
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
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
                    <h3 class="box-title">Welcome Admin</b></h3>
                </div>
                
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><a href="active-jobs.php"><i class="fa fa-briefcase"></i> Active Drives</a></li>
                    <li><a href="applications.php"><i class="fa fa-address-card-o"></i> Students Profile</a></li>
                    <!-- <li><a href="companies.php"><i class="fa fa-building"></i> Drives</a></li> -->
                    <li><a href="companies.php"><i class="fa fa-arrow-circle-o-right"></i> Placement Coordinators</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">

              <h3>Active Drives</h3>
              <div class="row margin-top-20">
                <div class="col-md-12">
                  <div class="box-body table-responsive no-padding">
                  <style>
    .table-bordered th,
    .table-bordered td {
        border: 1px solid white;
    }
</style>

<table id="example2" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Drive Name</b></th>
            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Date Created</b></th>
            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">View</b></th>
            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Delete</b></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM job_post";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['jobtitle']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                    <td><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-address-card-o"></i></a></td>
                    <td><a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-trash"></i></a></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>


    </div>
  </div>

  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>

  <script>
    $(function() {
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
      });
    });
  </script>
</body>

</html>
