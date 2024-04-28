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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
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
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li class="active"><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-md-9 bg-white padding-2">
              <h4><i>Talent Database</i></h4>
              <p>In this section you can download resume of all candidates who applied to your job posts</p>
              <div class="row margin-top-20">
                <div class="col-md-12">
                  <div class="box-body table-responsive no-padding">
                  <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Candidate</b></th>
                            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Highest Qualification</b></th>
                            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Skills</b></th>
                            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">City</b></th>
                            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">State</b></th>
                            <th><b style="color:white; font-size: larger; font-weight: bold; font-style: italic;">Download Resume</b></th>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->prepare("SELECT users.firstname, users.lastname, users.qualification, users.skills, users.city, users.state, users.resume FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost INNER JOIN users ON users.id_user=apply_job_post.id_user WHERE apply_job_post.id_company=? GROUP BY users.id_user");
                            $stmt->bind_param("i", $_SESSION['id_company']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    $skills = $row['skills'];
                                    $skills = explode(',', $skills);
                            ?>
                                    <tr>
                                        <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                        <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['qualification']; ?></td>
                                        <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;">
                                            <?php
                                            foreach ($skills as $value) {
                                                echo ' <span class="label label-success">' . $value . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['city']; ?></td>
                                        <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['state']; ?></td>
                                        <td style="color: #8B0000; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><a href="../uploads/resume/<?php echo $row['resume']; ?> " download="<?php echo $row['firstname'] . ' Resume'; ?>"><i class="fa fa-file-pdf-o"></i></a></td>
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

    <footer class="main-footer" style="margin-left: 0px;">
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
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
