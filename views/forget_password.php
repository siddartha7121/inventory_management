<!-- php code for send one time password to email -->
<?php

use inventory\login1;

require 'C:\xampp\htdocs\REPOSITORYPHP\logo_common.php';
require 'C:\xampp\htdocs\REPOSITORYPHP\inventory.php';
require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
// random number
$min = 100000; // Minimum value
$max = 999999; // Maximum value
$randomNumber = rand($min, $max);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit1"])) {
  // sending email;
  $randomNumber1 = "your otp is $randomNumber please don't share with other";
  $email = $_POST["email"];
  $tablename = $_POST["table"];
  $body = "INFANION OTP";
  $s = new login1($tablename, $email, "");
  $row = $s->fetchDetails();
  if ($row) {
    $_SESSION['mail'] = $email;
    $_SESSION['random'] = $randomNumber;
    $_SESSION['id'] = $row['id'];
    $_SESSION['tablename'] =  $tablename;
    // fsd($email, $body, $randomNumber1);
    header("Location: otp.php");
    exit();
  }
  echo '<div class="alert alert-success d-flex mx-3" role="alert">
                    <strong>Error</strong><p>please enter the valid Email</p>
                  </div>';
}
logoimg(); ///for logo display/////////
?>
<!--end  php code for send one time password to email -->
<!-- end logo of product -->
<div id="mailenter" class="container d-flex justify-content-center">
  <div class="mb-3 col-6">
    <div class="col-12"><span id="provide_email_span">please provide your registered Gmail ID.
        We will send a
        6-digit OTP to reset your password</span></div>
    <form method="post">
      <label for="exampleInputEmail1" id="button_label" class="form-label">Enter your
        registered email ID</label>
      <input name="email" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Please enter your registered email" required>
      <!-- ejfnkef -->
      <select class="btn-group d-block mt-3" name="table">
        <option value="admin">admin</option>
        <option value="employees">employee</option>
      </select>
      <!-- g4ggr -->
      <button name="submit1" type="submit" class="btn btn-primary mt-4">Send
        OTP</button>
    </form>
  </div>
</div>
</body>

</html>