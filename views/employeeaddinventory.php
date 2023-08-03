<?php

use function inventory\admin;


include 'C:\xampp\htdocs\REPOSITORYPHP\inventory.php';
require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
require 'C:\xampp\htdocs\REPOSITORYPHP\logo_common.php';
//////////////
Destroy();
/////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $devicename = $_POST['devicename'];
  $image = $_POST['image12'];
  $stmt = "C:\Users\siddu\Downloads/";
  $path = $stmt . $image;
  echo $path;
  $updatedFileContents = file_get_contents("$path");
  global $connection;
  $query = "INSERT INTO inventory (deviceName, image) VALUES (?, ?)";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $devicename, $updatedFileContents);
  // Execute the prepared statement
  $res = mysqli_stmt_execute($stmt);
  // fsd($emailid, $randomNumber);
  if ($res) {
    echo "<div class='alert alert-success' role='alert'>
                    !item added successfully!
                   </div>";
  } else {
    echo "<div class='alert alert-danger' role='alert'>
           !failed to add an item!
           </div>" . mysqli_error($connection);
  }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
$res = admin();
navEmployee('common-button', 'bg-onclick', 'common-button', 'common-button', 'common-button');


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