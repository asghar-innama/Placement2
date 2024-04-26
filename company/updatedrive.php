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
        <?php include 'header.php'; ?>

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
                                        <li><a href="edit-company.php"><i class="fa fa-tv"></i> Update Profile</a></li>
                                        <li><a href="create-job-post.php"><i class="fa fa-file-o"></i> Post Drive</a></li>
                                        <li class="active"><a href="my-job-post.php"><i class="fa fa-file-o"></i> Current Drives</a></li>
                                        <li><a href="job-applications.php"><i class="fa fa-file-o"></i> Drive Applications</a></li>
                                        <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                                        <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                                        <li><a href="resume-database.php"><i class="fa fa-user"></i> Resume Database</a></li>
                                        <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 bg-white padding-2">
                            <h2>Update Drive</h2>
                            <p>In this section you can change drive details.</p>
                            <div class="row">
                                <form action="updatedrive1.php" method="post" enctype="multipart/form-data">
                                    <?php
                                    $sql = "SELECT * FROM job_post WHERE id_jobpost=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $_SESSION['id_jobpost']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <div class="col-md-6 latest-job">
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
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="control-sidebar-bg"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="../js/adminlte.min.js"></script>
</body>
</html>
