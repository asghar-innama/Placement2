<?php
session_start();

if (isset($_SESSION['id_user']) || isset($_SESSION['id_company'])) {
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
  <link href="img/logo.png" rel="icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Font -->
  <style>
    .login-logo,
.register-logo {
  font-size: 35px;
  text-align: center;
  margin-bottom: 25px;
  font-weight: 300;
  margin-top: 20px; /* Adding a top margin of 20px */
}
.login-logo a,
.register-logo a {
  color: #444;
  font-weight: 300;
  font-size: 30px;
  text-align: center;
  color: black;
  font-family: "Times New Roman", Times, serif;
}
.login-page,
.register-page {
  background: #d2d6de;
}
.login-box,
.register-box {
  width: 360px;
  margin: 7% auto;
  background: #004080;
  padding-bottom: 10px; /* Adjust the value as needed */
}

@media (max-width: 768px) {
  .login-box,
  .register-box {
    width: 90%;
    margin-top: 20px;
  }
}
.login-box-body,
.register-box-body {
  background: #fff;
  padding: 20px;
  border-top: 60px; /* Adjust the value as needed */
  color: #666;
}
.login-box-body .form-control-feedback,
.register-box-body .form-control-feedback {
  color: #777;
}
.login-box-msg,
.register-box-msg {
  margin: 0;
  text-align: center;
  padding: 0 20px 20px 20px;
}
  </style>
</head>
<body class="hold-transition login-page bg-white text-black">
<?php
  include 'uploads/jobs_header.php';
  ?>
  <!-- </header> -->
  <div class="login-box hello">
    <div class="login-logo ">
    <a href="index.php" style="color:white; font-family: 'Times New Roman', Times, serif; margin-top: 10px;"><b>Placement Official Portal</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body bg-blue-200 text-black ">
    <p class="login-box-msg text-3xl" style="color: black; font-weight: bold;">Login</p>
      <form method="post" action="checklogin.php " class="text-xl">
        <div class="form-group has-feedback">
          <input type="email" id="large" name="email" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="large" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row ">
          <div class="col-xs-8">
            <a href="#">Forgot your password?</a>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="flex mx-auto mt-6 text-white bg-blue-900 border-0 py-2 px-5 focus:outline-none hover:bg-blue-800 rounded">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <br>

      <?php
      //If User have successfully registered then show them this success message
      //Todo: Remove Success Message without reload?
      if (isset($_SESSION['registerCompleted'])) {
      ?>
        <div>
          <p id="successMessage" class="text-center">You Have Registered Successfully! Your Account Approval Is Pending By Placement-Officer</p>
        </div>
      <?php
        unset($_SESSION['registerCompleted']);
      }
      ?>
      <?php
      //If User Failed To log in then show error message.
      if (isset($_SESSION['loginError'])) {
      ?>
        <div>
          <p class="text-center">Invalid Email/Password! Try Again!</p>
        </div>
      <?php
        unset($_SESSION['loginError']);
      }
      ?>

      <?php
      //If User Failed To log in then show error message.
      if (isset($_SESSION['userActivated'])) {
      ?>
        <div>
          <p class="text-center">Your Account Is Active. You Can Login</p>
        </div>
      <?php
        unset($_SESSION['userActivated']);
      }
      ?>

      <?php
      //If User Failed To log in then show error message.
      if (isset($_SESSION['loginActiveError'])) {
      ?>
        <div>
          <p class="text-center"><?php echo $_SESSION['loginActiveError']; ?></p>
        </div>
      <?php
        unset($_SESSION['loginActiveError']);
      }
      ?>

    </div>
    <a class="text-xl text-white font-bold ml-4" style="margin-top: 0.5cm; text-decoration: underline;" href="register-candidates.php">Create new account</a>
    <!-- /.login-box-body -->
  </div>

  <div style="margin: bottom 0px; " class="  sm:mt-48 ">
    <footer id="footer" class="text-gray-600 body-font bg-gray-800 border-t-2 border-gray-700 small mb-0 ">

      <div class="pt-1 pb-2">
        <ul class="flex  space-x-16 justify-center text-white my-4 ">
          <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
          <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
          <li><i class="fa fa-instagram" aria-hidden="true"></i></li>
          <li><i class="fa fa-linkedin" aria-hidden="true"></i></li>

        </ul>

      <br>

      </div>

    </footer>
    
  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
  <!-- iCheck -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
  <script type="text/javascript">
    $(function() {
      $("#successMessage:visible").fadeOut(8000);
    });
  </script>

</body>

</html>