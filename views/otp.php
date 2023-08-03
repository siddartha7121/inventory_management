<?php session_start();
require 'C:\xampp\htdocs\REPOSITORYPHP\logo_common.php';
//////////////
Destroy();
/////////////
print_r($_SESSION);
if (isset($_SESSION['mail']) && isset($_SESSION['random'])) {
      // global $email;
      $email = $_SESSION['mail'];
      $random = $_SESSION['random'];
      if (isset($_POST["submit"])) {
            if ($_POST["otp"] == $random) {
                  header("Location: updatepasssword.php");
                  exit();
            }
      } else {
            echo 'otp is not correct session expire go back and enter email again';
            // session_destroy();
      }
}
logoimg(); ///for logo display/////////
?>
<div class="container d-flex justify-content-center">
      <div class="mb-3 col-6">
            <form action="" method="post">
                  <label for="exampleInputPassword1" class="form-label">Enter 6-digit
                        OTP
                        number</label>
                  <input id="otp" name="otp" type="number" class="form-control" id="exampleInputPassword1" placeholder="Please enter your one-time password" required>
                  <label for="exampleInputPassword1" class="form-label mt-3">OTP WILL EXPIRE IN</label>
                  <p id="siddu"></p>
                  <button name="submit" type="submit" class="btn btn-primary mt-3">Submit
                        OTP</button>
            </form>
      </div>
</div>