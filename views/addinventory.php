<?php

use function inventory\admin;


require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
//////////////
Destroy();
/////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $devicename = $_POST['devicename'];
  $image = $_POST['image12'];
  $stmt = "C:\Users\siddu\Downloads/";
  $path = $stmt . $image;
  // echo $path;
  $updatedFileContents = file_get_contents("$path");
  global $connection;
  $query = "INSERT INTO inventory (deviceName, image) VALUES (?, ?)";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $devicename, $updatedFileContents);
  // Execute the prepared statement
  $res = mysqli_stmt_execute($stmt);
  // fsd($emailid, $randomNumber);
  if ($res) {
    echo "<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
    <strong>SUCCESS!</strong> one inventory added successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  } else {
    echo "<div class='w-100 alert alert-danger alert-dismissible fade show position-absolute' role='alert'>
    <strong>Failed!</strong> failed to add inventory.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>" . mysqli_error($connection);
  }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
$res = admin();
nav('common-button', 'common-button', 'bg-onclick', 'common-button', 'common-button', 'common-button', 'common-button', $res);


?>
<!-- for add emp -->
<div class="container w-50">
  <div class="div">
    <h2>ADD NEW DEVICE</h2>
  </div>
  <form method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" id="button_label" class="form-label">DEVICE NAME</label>
      <input name="devicename" type="text" class="form-control" id="exampleInputEmail1" placeholder="please enter the new device name" required>
    </div>
    <div class="mb-3">
      <label for="formFileSm" class="form-label">PLEASE
        ATTACH DEVICE
        IMAGE</label>
      <input name="image12" class="form-control form-control-sm" id="formFileSm" type="file" accept="image/jpeg, image/png, image/gif,image/jpg">

    </div>
    <button name="submit" type="submit" class="btn btn-primary">ASSIGN</button>
</div>
</form>
</div>
</body>

</html>