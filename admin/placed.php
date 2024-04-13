<?php
session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");

// Prepare the statement to select data
$sql = "SELECT users.firstname, users.lastname, users.email, job_post.jobtitle, job_post.role, job_post.minimumsalary 
        FROM users 
        INNER JOIN apply_job_post ON users.id_user = apply_job_post.id_user 
        INNER JOIN job_post ON apply_job_post.id_jobpost = job_post.id_jobpost";

$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt) {
    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($firstname, $lastname, $email, $jobtitle, $role, $minimumsalary);

    // Start HTML output
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
            <?php include 'header.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="margin-left: 0px;">
                <section id="candidates" class="content-header">
                    <div class="container">
                        <div class="col md-4">
                            <h3 style="text-align: center; color:black; ">Placed Students list </h3>
                            <h3 style="color:black;">Filters</h3>
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                            <a href="export1.php"><button type="submit1" name='export_excel_btn' class="btn btn-primary">Export to Excel</button></a>
                            <button type="submit1" onclick="sortTable()" name='export_excel_btn' style="margin-left: 8px;" class="btn btn-success">Sort Data</button>
                        </div>
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <div class="box-body table-responsive no-padding">
                                    <table id="example2" class="table table-hover">
                                        <tr class="header">
                                            <th style="width:20%;">Student Name</th>
                                            <th style="width:30%;">Student Email</th>
                                            <th style="width:20%;">Company Name</th>
                                            <th style="width:20%;">Role</th>
                                            <th style="width:20%;">CTC</th>
                                        </tr>
                                        <tbody>
                                            <?php
                                            // Fetch the results
                                            while ($stmt->fetch()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $firstname . ' ' . $lastname; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td><?php echo $jobtitle; ?></td>
                                                    <td><?php echo $role; ?></td>
                                                    <td><?php echo $minimumsalary; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer" style="margin:auto;bottom: 0;width: 100%;height: 50px; position:absolute; background-color:#1f0a0a; color:white">
        </footer>
        <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../js/adminlte.min.js"></script>
    </body>

    </html>
    <!-- script to sort data  -->
    <script>
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("example2");
            switching = true;
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[0];
                    y = rows[i + 1].getElementsByTagName("TD")[0];
                    // Check if the two rows should switch place:
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
    <!-- script for filtering table on the basis of company name  -->
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("example2");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <style>
        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #example2 {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #example2 th,
        #example2 td {
            text-align: left;
            padding: 12px;
        }

        #example2 tr {
            border-bottom: 1px solid #ddd;
        }

        #example2 tr.header,
        #example2 tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <?php
    // Close the statement
    $stmt->close();
} else {
    // Handle statement preparation error
    echo "Error preparing statement: " . $conn->error;
}

// Close the connection
$conn->close();
?>
