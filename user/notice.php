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
                        <div class="col-md-2"></div>
                        <div class="col-md-8 bg-white padding-2">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h4>Posted Notice</h4>
                                </div>

                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table">
                                            <tr>
                                                <th><b style="color:black; font-size: larger; font-weight: bold; font-style: italic;">Subject</th>
                                                <th><b style="color:black; font-size: larger; font-weight: bold; font-style: italic;">Notice</th>
                                                <th><b style="color:black; font-size: larger; font-weight: bold; font-style: italic;">Attachment</th>
                                                <th><b style="color:black; font-size: larger; font-weight: bold; font-style: italic;">Date and Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM notice WHERE audience='All Students'";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td style="color: #8B0000;background: white; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['subject']; ?></td>
                                                        <td style="color: #8B0000;background: white; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['notice']; ?></td>
                                                        <?php if ($row['resume'] != '') { ?>
                                                            <td style="color: #8B0000;background: white; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><a href="../uploads/resume/<?php echo $row['resume']; ?>" download="<?php echo 'Notice'; ?>"><i class="fa fa-file"></i></a></td>
                                                        <?php } else { ?>
                                                            <td style="color: #8B0000;background: white; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;">No Resume Uploaded</td>
                                                        <?php } ?>
                                                        <td style="color: #8B0000;background: white; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-style: normal;"><?php echo $row['date']; ?></td>
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
            </section>
        </div>
    </div>
</body>

</html>

<style>
    #heading {
        text-align: center;
        margin-bottom: 50px;
    }
</style>
