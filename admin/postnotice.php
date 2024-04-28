<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Placement Portal</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b style="color:black; font-size: medium; font-weight: bold; font-style: italic;">Post a New Notice</h3>
                    </div>
                    <div class="box-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject" name="subject">
                            </div>
                            <div class="form-group">
                                <input type="file" class="btn btn-primary" name="resume">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Notice" name="input" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Audience</label>
                                <select class="form-control" name="audience">
                                    <option value="All Students">All Students</option>
                                    <option value="Co-ordinators">Co-ordinators</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" name="submit" type="submit">Notify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b style="color:black; font-size: medium; font-weight: bold; font-style: italic;">Posted Notices</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Notice</th>
                                    <th>Audience</th>
                                    <th>File</th>
                                    <th>Date and Time</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP loop to display posted notices -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    body {
        background-color: #fff;
    }

    .box-header {
        background-color: white;
        color: #fff;
    }

    .box-title {
        margin-top: 0;
    }

    .form-control {
        border-radius: 0;
    }

    .btn-primary {
        border-radius: 0;
    }

    .table {
        margin-top: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
</style>
