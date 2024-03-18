<?php
  /*
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials

  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>*/
<?php
//session_start();
include('login.php');
if (empty($_SESSION['name'])) {
    header("location:signin.php");
    exit; // Stop executing the code after redirection
}

$emailid = $_SESSION['email'];
$connection=mysqli_connect("localhost:3307","root","");
$db=mysqli_select_db($connection,'placement_portal');
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    //$email = mysqli_real_escape_string($connection, $_POST['email']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    $query = "INSERT INTO user_feedback(name,email,message) VALUES('$name','$emailid','$message')";
    $stmt = mysqli_query($connection, $query);
    if ($stmt) 
    {
      echo '<script type="text/javascript">alert("Data saved");</script>';

    }
    else {
        echo '<script type="text/javascript">alert("Data not saved");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>contact</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="contact.css">
</head>

<body>
  <header>
    <div class="logo">Sustainable <b style="color: #FFD700;">Bites</b></div>
    <div class="hamburger">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
    <nav class="nav-bar">
      <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li> <a href="contact.php" class="active">Contact</a> </li>
        <li><a href="profile.php">Profile</a></li>
      </ul>
    </nav>
  </header>
  <script>
    hamburger = document.querySelector(".hamburger");
    hamburger.onclick = function () {
      navBar = document.querySelector(".nav-bar");
      navBar.classList.toggle("active");
    }
  </script>
  <section class="cover">

  </section>
  <div class="contact-form">
    <form action="" method="post"> <label for="name">Name:</label>
      <input type="text" id="name" name="name">
      <br> <label for="email">Email:</label>
      <input type="email" id="email" name="email">
      <br> <label for="message">Message:</label> <textarea id="message" name="message"></textarea>
      <br>
      <div class="btn">
            <button type="submit" name="submit">SUBMIT</button>
        </div>
    </form>
  </div>
  <div class="contact-info" style="padding: 10px;">
    <p>Email: sustainable_bites@gmail.com</p>
    <p>Phone: 9616925773, 7000686060, 8434673061</p>
    <p>Address: Christ (Deemed to be University), Bangalore, Karnataka - 560029</p>
  </div>

  <div class="help">
    <p style="font-size: 23px; text-align: center; padding:10px;">Help & FAQs?</p>

    <button class="accordion">How Do I Donate Food ?</button>
    <div class="panel">
      <p>1)click on <a href="fooddonateform.php">DONATE</a> in home page </p>
      <p>2)fill the details </p>
      <p>3)click on submit</p>
      <img src="" alt="" width="100%">
    </div>

    <button class="accordion">What Happens to My Donation?</button>
    <div class="panel">
      <p style="padding: 10px;"> Your donation will be used to support our mission by providing assistance and support to
        those in need. If you have any specific questions or concerns, please feel free to contact us</p>
        <br>
    </div>

    <button class="accordion">What should I do if my food donation is near or past its expiration date?</button>
    <div class="panel">
      <p style="padding: 10px;">We appreciate your willingness to donate, but to ensure the safety of our clients we
        can't accept food that is near or past its expiration date. We recommend checking expiration dates before making
        a donation or contact us for further guidance</p>
        <br>
    </div>
  </div>

  </div>

</body>
<script>
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
</script>

</html>