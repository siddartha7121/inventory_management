<?php

use inventory\login1;

require 'C:\xampp\htdocs\REPOSITORYPHP\inventory.php';
require 'C:\xampp\htdocs\REPOSITORYPHP\logo_common.php';
global $x;
if (isset($_POST["submit"])) {
          $userid = $_POST["username"];
          $password = $_POST["password"];
          $tableName = 'employees';
          $ret = new login1("$tableName", "$userid", "$password");
          $x = $ret->loginOf();
}
logoimg(); ///////// Display logo/////////
?>
<!-- Login form display btn-->
<div class="container">
          <div class="row">
                    <div class="col-6">

                              <div class="card card-body login h-100 ">
                                        <div class="container">
                                                  <div class="row d-flex justify-content-center">
                                                            <div class="col d-flex justify-content-center mb-3">
                                                                      <i class="bi bi-person-circle icon"></i>
                                                            </div>
                                                  </div>
                                                  <div class="container">
                                                            <div class="row d-flex justify-content-center">
                                                                      <div class="col d-flex justify-content-center icon">
                                                                                <h3>EMPLOYEE</h3>
                                                                      </div>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                      <h5 class="link-danger d-flex justify-content-center">
                                                                                <?php if ($x) {
                                                                                          echo 'incorrect user id or password';
                                                                                } ?></h5>
                                                                      <div class="col-8">
                                                                                <form action="" method="post">
                                                                                          <div class="mb-3">
                                                                                                    <label for="exampleInputEmail1" id="button_label" class="form-label span">enter
                                                                                                              ur
                                                                                                              email
                                                                                                              id</label>
                                                                                                    <input name="username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="please enter your userid" required>
                                                                                          </div>
                                                                                          <div class="mb-3">
                                                                                                    <label for="exampleInputPassword1" class="form-label span">Password</label>
                                                                                                    <p class="text-danger" id='pasval'>
                                                                                                    </p>
                                                                                                    <div class="row pe-3">
                                                                                                              <div class="col-10 pe-0">
                                                                                                                        <input name="password" type="password" class="form-control d-flex" id="exampleInputPassword1" placeholder="please enter your password" required>
                                                                                                              </div>
                                                                                                              <div id='hide' class="col bg-white rounded" hidden>
                                                                                                                        <i class="bi bi-eye-fill ms-1 fs-4"></i>
                                                                                                              </div>
                                                                                                              <div id='display' class="col bg-white rounded">
                                                                                                                        <i class="bi bi-eye-slash-fill ms-1 fs-4"></i>
                                                                                                              </div>

                                                                                                    </div>
                                                                                          </div>
                                                                                          <button name="submit" type="$submit" id="login" class="btn btn-primary bg-onclick m-auto"><i class=" mt-1 me-3 bi bi-box-arrow-in-right"></i>LOGIN</button>
                                                                                          <a class="link-danger mx-5 link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="forget_password.php">FORGET
                                                                                                    PASSWORD</a>
                                                                                </form>
                                                                      </div>
                                                            </div>
                                                  </div>
                                        </div>
                              </div>
                    </div>
                    <div class="col-6">
                              <img style="width: 100%;" src="image/employee.png" alt="admin img">
                    </div>
          </div>
</div>