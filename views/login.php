<?php

use inventory\login1; //name space for the login class///////////////////
require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////////// code for admin login//////////////////////////////
/////////if employee  not loged out no need to login again if went to login page in will redirected to user interface//////////////
if (!empty($_SESSION)) {
          $employee = $_SESSION['employee'];
          // print_r($_SESSION);
          if ($employee['branch'] == 3) {
                    header("Location:adminAddEmp.php");
          }
          if ($employee['branch'] == 1) {
                    header("Location:employees.php");
          }
          if ($employee['branch'] == 2) {
                    header("Location:hr.php");
          }
}
// Destroy();
global $x;
if (isset($_POST["submit"])) {
          $username = $_POST["username"];
          $password = $_POST["password"];
          $tableName = $_POST["key"];
          $ret = new login1("$tableName", "$username", "$password");
          $x = $ret->loginOf();
}
logoimg(); ///for logo display/////////
?>
<div id="id" class="container overflow-hidden">
          <div class="row bgimg m-0 p-0">
                    <div class="col-6 p-0"></div>
                    <div class="col-6 p-0 clippath">
                              <div class="row d-flex justify-content-center mt-2">
                                        <div class="col d-flex justify-content-center mb-3">
                                                  <i class="bi bi-person-circle icon"></i>
                                        </div>
                              </div>
                              <div class="row d-flex justify-content-center position-relative">
                                        <div id="admin" class="col d-flex justify-content-center icon position-absolute">
                                                  <h3>ADMIN</h3>
                                        </div>
                                        <div id="employee" class="col d-flex justify-content-center icon position-absolute">
                                                  <h3>EMPLOYEE</h3>
                                        </div>
                                        <div id="log" class="col d-flex justify-content-center icon position-absolute">
                                                  <h3>LOGIN</h3>
                                        </div>
                              </div>
                              <div class="formdiv">
                                        <form method="post">
                                                  <span class="link-danger  d-flex justify-content-center">
                                                            <?php if ($x) {
                                                                      echo $x;
                                                                      $x = "";
                                                            } ?>
                                                            <span class="opacity-0">x</span>
                                                  </span>
                                                  <div class=" mb-5">
                                                            <label class="form-label lable span">Email
                                                                      Id</label>
                                                            <input name="username" type="email" class="form-control posiitioninput " id="exampleInputEmail1" autocomplete="off" aria-describedby="emailHelp" required>
                                                  </div>
                                                  <div>
                                                            <label class="form-label lable span">Password</label>
                                                            <div class="row pe-3">
                                                                      <div class="pe-0">
                                                                                <input name="password" type="password" class="form-control posiitioninput" id="exampleInputPassword1" required>
                                                                                <i id="hide" class="bi bi-eye-fill ms-1 fs-4 posiitioneye span " hidden></i>
                                                                                <i id="display" class="bi bi-eye-slash-fill ms-1 fs-4 posiitioneye span"></i>
                                                                      </div>
                                                                      <p class="text-danger m-0" id='pasval'>
                                                                                Password must have a minimum
                                                                                length of 8 characters
                                                                      </p>
                                                            </div>
                                                  </div>
                                                  <div>
                                                            <input name="key" value="admin" class="radio" type="radio"><label class="span">ADMIN</label>
                                                            <input name="key" value="employees" class="radio" type="radio"><label class="span">EMPLOYEE</label>
                                                  </div>
                                                  <button name="submit" id="login" type="$submit" class="btn btn-primary bg-onclick mt-2"><i class=" mt-1 me-3 bi bi-box-arrow-in-right"></i>LOGIN</button>
                                                  <a class=" link-danger m-5 link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="forget_password.php">FORGET
                                                            PASSWORD</a>
                                        </form>
                              </div>
                    </div>

          </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>