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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <?php
    include 'header.php';
    ?>
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
                    <li class="active"><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-md-9 bg-white padding-2">
              <section class="content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title" style="margin-bottom: 20px;">Mailbox</h4>
                      </div>
                      <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                          <table id="example1" class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Subject</th>
                                <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $stmt = $conn->prepare("SELECT * FROM mailbox WHERE id_fromuser=? OR id_touser=?");
                              $stmt->bind_param("ii", $_SESSION['id_company'], $_SESSION['id_company']);
                              $stmt->execute();
                              $result = $stmt->get_result();
                              if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                              ?>
                                  <tr>
                                    <td class="mailbox-subject" style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><a href="read-mail.php?id_mail=<?php echo $row['id_mailbox']; ?>"><?php echo $row['subject']; ?></a></td>
                                    <td class="mailbox-date" style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo date("d-M-Y h:i a", strtotime($row['createdAt'])); ?></td>
                                  </tr>
                              <?php
                                }
                              }
                              ?>
                            </tbody>

                            <tfoot>
                              <tr>
                                <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Subject</th>
                                <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Date</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                      <div class="box-footer">
                        <a href="create-mail.php" class="btn btn-warning btn-flat"><i class="fa fa-envelope"></i> Create</a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </section>
    </div>

    <footer class="main-footer" style="margin-left: 0px;">
    </footer>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/adminlte.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script>
    $(function() {
      $('#example1').DataTable();
    })
  </script>
</body>
</html>