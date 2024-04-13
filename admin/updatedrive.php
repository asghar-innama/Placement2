<?php
session_start();

if (empty($_SESSION['id_jobpost'])) {
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
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="../css/custom.css">

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
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-8 bg-white padding-2">
                            <h2 style = "color:white;" >Update Drive</h2>
                            <p>In this section you can change drive details.</p>
                            <div class="row">
                                <form action="updatedrive1.php" method="post" enctype="multipart/form-data">
                                    <?php
                                    $sql = "SELECT * FROM job_post WHERE id_jobpost='$_SESSION[id_jobpost]'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <div class="col-md-6 latest-job ">
                                            <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" class="form-control input-lg" name="companyname" id="companyname" value="<?php echo $row['jobtitle']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <input type="text" class="form-control input-lg" name="role" id="role" value="<?php echo $row['role']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Eligibility</label>
                                                    <input type="text" class="form-control input-lg" name="Eligibility" id="Eligibility" value="<?php echo $row['eligibility']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>CTC</label>
                                                    <input type="text" class="form-control input-lg" name="CTC" id="CTC" value="<?php echo $row['minimumsalary']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Qualification Required</label>
                                                    <input type="text" class="form-control input-lg" name="qualification" id="qualification" value="<?php echo $row['qualification']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Company URL</label>
                                                    <input type="text" class="form-control input-lg" name="companyurl" id="companyurl" value="<?php echo $row['companyurl']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Max Number of Backlogs Allowed</label>
                                                    <input type="text" class="form-control input-lg" name="backlogs" id="backlogs" value="<?php echo $row['backlogs']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>CGPA Gained</label>
                                                    <input type="text" class="form-control input-lg" name="cgpa" id="cgpa" value="<?php echo $row['cgpa']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Job Description</label>
                                                    <textarea class="form-control input-lg" rows="4" name="description" id="description"><?php echo $row['description']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" id="submit" class="btn btn-flat btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class=" main-footer" style="margin-left: 0px;">
            
        </footer>

        <!-- /.control-sidebar -->
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
</body>
</html>