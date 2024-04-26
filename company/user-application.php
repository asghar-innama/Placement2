<?php
session_start();
if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}
require_once("../db.php");

// Check if there are any job applications for the company
$stmt = $conn->prepare("SELECT * FROM apply_job_post WHERE id_company=? AND id_user=?");
$stmt->bind_param("ii", $_SESSION['id_company'], $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();

// Redirect to index.php if there are no job applications
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
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
        <?php include 'header.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">
            <section id="candidates" class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Welcome <b style="color:white;"><?php echo $_SESSION['name']; ?></b></h3>
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
                            <div class="row margin-top-20">
                                <div class="col-md-12">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user=?");
                                    $stmt->bind_param("i", $_GET['id']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // If Job Post exists then display details of post
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <div class="pull-left">
                                                <h2><b style="color:white;"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></b></h2>
                                            </div>
                                            <div class="pull-right">
                                                <a href="job-applications.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <div>
                                                <?php
                                                echo 'Email: ' . $row['email'];
                                                echo '<br>';
                                                echo 'City: ' . $row['city'];
                                                echo '<br>';

                                                if ($row['resume'] != "") {
                                                    echo '<a href="../uploads/resume/' . $row['resume'] . '" class="btn btn-info" download="Resume">Download Resume</a>';
                                                }

                                                ?>
                                                <div class="row">
                                                    <div class="col-md-3 pull-right">
                                                        <a href="reject.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $_GET['id_jobpost']; ?>" class="btn btn-danger">Reject Application</a>
                                                    </div>
                                                    <div class="col-md-3 pull-right">
                                                        <a href="under-review.php?id=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $_GET['id_jobpost']; ?>" class="btn btn-success">Mark as Placed</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-md-9 bg-white padding-2">
                                    <h3>Candidates Database</h3>
                                    <div class="row margin-top-20">
                                        <div class="col-md-12">
                                            <div class="box-body table-responsive no-padding">
                                                <table id="example2" class="table table-hover">
                                                    <thead>
                                                        <th>Candidate</th>
                                                        <th>Highest Qualification</th>
                                                        <th>Skills</th>
                                                        <th>City</th>
                                                        <th>State</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT * FROM users";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {

                                                                $skills = $row['skills'];
                                                                $skills = explode(',', $skills);
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                                                    <td><?php echo $row['qualification']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        foreach ($skills as $value) {
                                                                            echo ' <span class="label label-success">' . $value . '</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $row['city']; ?></td>
                                                                    <td><?php echo $row['state']; ?></td>
                                                                    <?php if ($row['resume'] != '') { ?>

                                                                    <?php } ?>
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
</body>

</html>
