<?php

use inventory\update;

require 'C:\xampp\htdocs\REPOSITORYPHP\logo_common.php';
include 'C:\xampp\htdocs\REPOSITORYPHP\inventory.php';
//////////////
Destroy();
/////////////
$email = $_SESSION['mail'];
$id = $_SESSION['id'];
$tablename = $_SESSION['tablename'];
if (isset($_POST["submit"])) {
          if ($_POST["pass1"] == $_POST["pass2"]) {

                    $password = $_POST["pass1"];
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $obj = new update;
                    $obj->updateTable($tablename, 'password', $hashedPassword, 'id', $id);
                    header("Location: main.php");
                    exit();
          }
          echo 'passwords you enterd not same';
}
logoimg(); ///for logo display/////////
?>
<!-- end logo of product -->
<div class="container d-flex justify-content-center">
          <div class="mb-3 col-6 form-check">
                    <form action="" method="post">
                              <label for="exampleInputEmail1" id="button_label" class="form-label">Enter new
                                        password</label>
                              <input name="pass1" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
                              <label for="exampleInputEmail1" id="button_label" class="form-label">Confirm
                                        password</label>
                              <input name="pass2" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
                              <button name="submit" type="submit" class="btn btn-primary mt-3">update</button>
                    </form>
          </div>
</div>