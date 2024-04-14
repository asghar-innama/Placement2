<?php
session_start();

if (isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) {
  header("Location: index.php");
  exit();
}

require_once("db.php");
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
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">

  <?php
  include 'uploads/register_page_header.php';
  ?>
  <div class="wrapper">

    <div class="content-wrapper" style="margin-left: 0px;">

      <section class="content-header">
        <div class="container">
          <div class="row latest-job margin-top-50 margin-bottom-20 bg-white">
            <h3 class="text-center margin-bottom-20">Placement Cell Profile</h3>
            <form method="post" id="registerCompanies" action="addcompany.php" enctype="multipart/form-data">
              <div class="col-md-6 latest-job ">
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="companyname" placeholder="Designation">
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="website" placeholder="Website">
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control input-lg" rows="4" name="aboutme" placeholder="Roles & Responsibility"></textarea>
                </div>
                <div class="form-group checkbox">
                  <label><input type="checkbox" required> I accept terms & conditions</label>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-flat btn-success">Register</button>
                </div>
                <?php
                //If Company already registered with this email then show error message.
                if (isset($_SESSION['registerError'])) {
                ?>
                  <div>
                    <p class="text-center" style="color: red;">Email Already Exists! Choose A Different Email!</p>
                  </div>
                <?php
                  unset($_SESSION['registerError']);
                }
                ?>
                <?php
                if (isset($_SESSION['uploadError'])) {
                ?>
                  <div>
                    <p class="text-center" style="color: red;"><?php echo $_SESSION['uploadError']; ?></p>
                  </div>
                <?php
                  unset($_SESSION['uploadError']);
                }
                ?>
              </div>
              <div class="col-md-6 latest-job ">
                <div class="form-group">
                  <input class="form-control input-lg" type="password" name="password" placeholder="Password" required autocomplete="new-password">
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="password" name="cpassword" placeholder="Confirm Password" required>
                </div>
                <div id="passwordError" class="btn btn-flat btn-danger hide-me">
                  Password Mismatch!!
                </div>
                <div class="form-group">
                  <input class="form-control input-lg" type="text" name="contactno" placeholder="Phone Number" minlength="10" maxlength="10" autocomplete="off" onkeypress="return validatePhone(event);" required>
                </div>
                <div class="form-group">
                  <select class="form-control  input-lg" id="country" name="country">
                    <option selected="" value="">Select Country</option>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM countries");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row['name'] . "' data-id='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div id="stateDiv" class="form-group" style="display: none;">
                  <select class="form-control  input-lg" id="state" name="state">
                    <option value="" selected="">Select State</option>
                  </select>
                </div>
                <div id="cityDiv" class="form-group" style="display: none;">
                  <select class="form-control  input-lg" id="city" name="city">
                    <option selected="">Select City</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Upload your profile picture</label>
                  <input type="file" name="image" class="form-control input-lg">
                </div>
              </div>
            </form>

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
  <script src="js/adminlte.min.js"></script>

  <script type="text/javascript">
    function validatePhone(event) {

      var key = window.event ? event.keyCode : event.which;

      if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
        return true;
      } else if (key < 48 || key > 57) {
        return false;
      } else return true;
    }
  </script>

  <script>
    $("#country").on("change", function() {
      var id = $(this).find(':selected').attr("data-id");
      $("#state").find('option:not(:first)').remove();
      if (id != '') {
        $.post("state.php", {
          id: id
        }).done(function(data) {
          $("#state").append(data);
        });
        $('#stateDiv').show();
      } else {
        $('#stateDiv').hide();
        $('#cityDiv').hide();
      }
    });
  </script>

  <script>
    $("#state").on("change", function() {
      var id = $(this).find(':selected').attr("data-id");
      $("#city").find('option:not(:first)').remove();
      if (id != '') {
        $.post("city.php", {
          id: id
        }).done(function(data) {
          $("#city").append(data);
        });
        $('#cityDiv').show();
      } else {
        $('#cityDiv').hide();
      }
    });
  </script>
  <script>
    $("#registerCompanies").on("submit", function(e) {
      e.preventDefault();
      if ($('#password').val() != $('#cpassword').val()) {
        $('#passwordError').show();
      } else {
        $(this).unbind('submit').submit();
      }
    });
  </script>
</body>

</html>
