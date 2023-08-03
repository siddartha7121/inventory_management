<?php

use inventory\update;
use inventory\retrieveData;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////
Destroy();
/////////////
if (isset($_GET['id'])) {
  $deviceid = $_GET['id'];
  $o = new update;
  $res = $o->updateTable('inventory', 'remark', "lost", "deviceId", "$deviceid");
  if ($res) {
    echo "<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>SUCCESS!</strong>you lost orgainaisation proporty it causes panalty.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  } else {
    echo "<div class='alert alert-danger' role='alert'>
   !failed to complaint!
   </div>" . mysqli_error($connection);
    echo "<div class='alert alert-danger' role='alert'>
  !failed to complaint!
  </div>" . mysqli_error($connection);   // fsd($emailid, $randomNumber);
  }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
navEmployee('common-button', 'common-button', 'bg-onclick', 'common-button');
?>
<!-- for add emp -->
<div class="container w-50 mt-5">
  <div class="d-flex justify-content-center mb-3">
    <h2>YOUR ITEMS</h2>
  </div>
</div>
<div class="container mb-3">
  <?php
  global $connection;
  $employee = $_SESSION['employee'];
  $x = $employee['id'];
  $query = "SELECT deviceId,deviceName,date,assignedTo,remark,assignedDate FROM inventory WHERE assignedTo=$x";
  $result = mysqli_query($connection, $query);
  $ss = new retrieveData;
  $ss->tableDelete1($result, "ITem_LOSS", "COMPLANT", "", "deviceId");
  ?>
</div>

<script>
  function showAlert(event) {
    event.preventDefault(); // Prevent the default behavior of the anchor tag
    // Access the URL parameters
    var urlParams = new URLSearchParams(event.target.getAttribute("href"));
    var paramValue = urlParams.get('id');
    var result = confirm(
      "Are you sure you want to perform lost submission of item it will send notifications to admin?"
    );
    if (result) {
      event.target.href = "?id=" + paramValue;
      window.location.href = event.target.href;
    }
  }
</script>