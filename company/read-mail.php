<?php
session_start();
if (empty($_SESSION['id_company'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../db.php");
$stmt = $conn->prepare("SELECT * FROM mailbox WHERE id_mailbox=? AND (id_fromuser=? OR id_touser=?)");
$stmt->bind_param("iii", $_GET['id_mail'], $_SESSION['id_company'], $_SESSION['id_company']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['fromuser'] == "company") {
        $stmt1 = $conn->prepare("SELECT * FROM company WHERE id_company=?");
        $stmt1->bind_param("i", $row['id_fromuser']);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0) {
            $rowCompany = $result1->fetch_assoc();
        }
        $stmt2 = $conn->prepare("SELECT * FROM users WHERE id_user=?");
        $stmt2->bind_param("i", $row['id_touser']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
            $rowUser = $result2->fetch_assoc();
        }
    } else {
        $stmt1 = $conn->prepare("SELECT * FROM company WHERE id_company=?");
        $stmt1->bind_param("i", $row['id_touser']);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0) {
            $rowCompany = $result1->fetch_assoc();
        }
        $stmt2 = $conn->prepare("SELECT * FROM users WHERE id_user=?");
        $stmt2->bind_param("i", $row['id_fromuser']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
            $rowUser = $result2->fetch_assoc();
        }
    }
}
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 bg-white padding-2">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="mailbox.php" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                        <div class="box box-primary">
                                            <div class="box-body no-padding">
                                                <div class="mailbox-read-info">
                                                    <h3><?php echo $row['subject']; ?></h3>
                                                    <h5>From: <?php echo $rowCompany['companyname']; ?>
                                                        <span class="mailbox-read-time pull-right"><?php echo date("d-M-Y h:i a", strtotime($row['createdAt'])); ?></span>
                                                    </h5>
                                                </div>
                                                <div class="mailbox-read-message">
                                                    <?php echo stripcslashes($row['message']); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $stmtReply = $conn->prepare("SELECT * FROM reply_mailbox WHERE id_mailbox=?");
                                        $stmtReply->bind_param("i", $_GET['id_mail']);
                                        $stmtReply->execute();
                                        $resultReply = $stmtReply->get_result();
                                        if ($resultReply->num_rows > 0) {
                                            while ($rowReply =  $resultReply->fetch_assoc()) {
                                                ?>
                                                <div class="box box-primary">
                                                    <div class="box-body no-padding">
                                                        <div class="mailbox-read-info">
                                                            <h3>Reply Message</h3>
                                                            <h5>From: <?php if ($rowReply['usertype'] == "company") {
                                                                            echo $rowCompany['companyname'];
                                                                        } else {
                                                                            echo $rowUser['firstname'];
                                                                        } ?>
                                                                <span class="mailbox-read-time pull-right"><?php echo date("d-M-Y h:i a", strtotime($rowReply['createdAt'])); ?></span>
                                                            </h5>
                                                        </div>
                                                        <div class="mailbox-read-message">
                                                            <?php echo stripcslashes($rowReply['message']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="box box-primary">
                                            <div class="box-body no-padding">
                                                <div class="mailbox-read-info">
                                                    <h3>Send Reply</h3>
                                                </div>
                                                <div class="mailbox-read-message">
                                                    <form action="reply-mailbox.php" method="post">
                                                        <div class="form-group">
                                                            <textarea class="form-control input-lg" id="description" name="description" placeholder="Job Description"></textarea>
                                                            <input type="hidden" name="id_mail" value="<?php echo $_GET['id_mail']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-flat btn-success">Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
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
            <div class="text-center">
                <strong>Copyright &copy; 2022 <a href="scsit@Davv">Placement Portal</a>.</strong> All rights
                reserved.
            </div>
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