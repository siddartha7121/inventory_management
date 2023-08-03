<?php
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
logoimg(); ///for logo display/////////
/////////if employee  not loged out no need to login again if went to login page in will redirected to user
?>
<ul class="nav justify-content-center">
          <li class="nav-item main_button">
                    <div class="d">
                              <?php linkbutton('https://www.infanion.com/', 'ABOUT AS') ?></div>
          </li>
          <li class="nav-item main_button">
                    <?php linkbutton('../views/login.php', 'LOGIN TO INVENTORYMANAGEMENT') ?>
          </li>
          <!-- <li class="nav-item main_button">
                    <?php linkbutton('employeeLogin.php', 'EMPLOYEE') ?>
          </li> -->
</ul>
<div class="container">
          <div class="row">
                    <div class="col-6 mt-5">
                              <pre><h4 class="span">
This page for inventory management of
infanion.if you are not an
employeeee or not familiar with infanion
please skip it.It is for internal
management purpose if your employee of
infanion please read below in these app u
can login to your account and you
can check your inventory
list and also if you
for get password you can update your
password also.please
click on abow button
based on your de
</h4></pre>
                    </div>
                    <div class="col-6 ml-3">
                              <img src="../image/iinventort-removebg-preview.png" alt="main">
                    </div>
          </div>
</div>