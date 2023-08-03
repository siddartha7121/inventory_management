<?php

use inventory\insert;
use inventory\login1;
use function inventory\admin;
// use function inventory\addImg;
require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
//////////////
Destroy();
/////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userid = $_POST['name'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $mobilenumber = $_POST['mobilenumber'];
    $emailid = $_POST['emailid'];
    $branch = $_POST['branch'];
    $ch = new login1('employees', $emailid, '');
    $row = $ch->fetchDetails();

    if (!$row) {
        $o = new insert;
        $result = $o->insertInto(
            'employees',
            'name',
            'password',
            'mobilenumber',
            'emailid',
            'branch',
            "$userid",
            "$hashedPassword",
            "$mobilenumber",
            "$emailid",
            "$branch"
        );
        if ($result) {
            echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> one employee added successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
        $message = "hai $userid now your part of infanion family";
        $head = 'WELCOME ---> INFANION';
        // fsd($emailid, $head, $message);
    } else {
        echo "<div class='w-100 alert alert-danger alert-dismissible fade show position-absolute' role='alert'>
        <strong>FAILED!</strong> please check provided details.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
$res = admin();
nav('bg-onclick', 'common-button', 'common-button', 'common-button', 'common-button', 'common-button', 'common-button', $res)
?>
<!-- for add emp -->
<div class="container w-50">
    <div class="div">
        <h2>ADD EMPLOYEE</h2>
    </div>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" id="button_label" class="form-label">NAME</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="employee name" required>
        </div>
        <div class="mb-3">
            <label id="button_label" class="form-label">MOBILE
                NUMBER</label>
            <p class="span" id="numb"></p>
            <input name="mobilenumber" type="number" class="form-control" id="exampleInputmobilenumber" aria-describedby="emailHelp" placeholder="employee mibile number" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" id="button_label" class="form-label">EMAIL
                ID</label>
            <input name="emailid" type="email" class="form-control" id="exampleInputEmail11" aria-describedby="emailHelp" placeholder="employee email id" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <p class="span" id="pasval"></p>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder=" password" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Branch</label>
            <select class="form-select" aria-label="Default select example" name="branch" required>
                <option>select employee branch</option>
                <option value="1">EMPLOYEE</option>
                <option value="2">HR</option>

            </select>
        </div>
        <?php checkBox() ?>
        <button id="login" name="submit" type="submit" class="btn btn-primary">ADD NEW EMPLOYEE</button>
</div>
</form>
</body>

</html>
<!-- <div class="mb-3">
                              <label for="formFileSm" class="form-label">PLEASE ATTACH YOUR IMAGE</label>
                              <input name="image" class="form-control form-control-sm" id="formFileSm" type="file"
                                        accept="image/jpeg, image/png, image/gif,image/jpg">

                    </div> -->