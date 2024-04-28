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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
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
                    <li><a href="active-jobs.php"><i class="fa fa-briefcase"></i> Active Drives</a></li>
                    <li><a href="applications.php"><i class="fa fa-address-card-o"></i> Students Profile</a></li>
                    <li class="active"><a href="companies.php"><i class="fa fa-arrow-circle-o-right"></i> Co - Ordinators</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">

              <h3>Coordinators</h3>
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
        <!-- <th>Company Name</th> -->
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Account Creator Name</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Email</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Phone</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">City</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">State</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Country</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Status</b></th>
        <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Delete</b></th>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT name, email, contactno, city, state, country, active, id_company FROM company";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <!-- <td> -->
                    <!-- php echo $row['companyname'];  -->
                    <!-- </td>  -->
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['name']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['email']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['contactno']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['city']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['state']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['country']; ?></td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;">
                        <?php
                        if ($row['active'] == '1') {
                            echo "Activated";
                        } else if ($row['active'] == '2') {
                        ?>
                            <a href="reject-company.php?id=<?php echo $row['id_company']; ?>">Reject</a> <a href="approve-company.php?id=<?php echo $row['id_company']; ?>">Approve</a>
                        <?php
                        } else if ($row['active'] == '3') {
                        ?>
                            <a href="approve-company.php?id=<?php echo $row['id_company']; ?>">Reactivate</a>
                        <?php
                        } else if ($row['active'] == '0') {
                            echo "Rejected";
                        }
                        ?>
                    </td>
                    <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><a href="delete-company.php?id=<?php echo $row['id_company']; ?>">Delete</a></td>
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
