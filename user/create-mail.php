<?php
session_start();
if (empty($_SESSION['id_user'])) {
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
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#description',
            height: 150
        });
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <?php include 'header.php' ?>

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
                                        <li><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                                        <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                                        <li class="active"><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                                        <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                                        <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 bg-white padding-2">
                            <form action="add-mail.php" method="post">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Compose New Message</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <select name="to" class="form-control">
                                                <?php
                                                $sql = "SELECT id_company, companyname FROM apply_job_post INNER JOIN company ON apply_job_post.id_company=company.id_company WHERE apply_job_post.id_user=? AND apply_job_post.status='2'";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("i", $_SESSION['id_user']);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row['id_company'] . '">' . $row['companyname'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="subject" placeholder="Subject:">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control input-lg" id="description" name="description" placeholder="Job Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                                        </div>
                                        <a href="mailbox.php" class="btn btn-default"><i class="fa fa-times"></i> Discard</a>
                                    </div>
                                </div>
                            </form>
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