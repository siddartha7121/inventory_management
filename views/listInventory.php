<?php

use inventory\retrieveData;
use inventory\deleteRow;
use function inventory\admin;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
if (isset($_GET['id'])) {
  // print_r($_GET);
  $rowId = $_GET['id'];
  $s = new deleteRow;
  $s->deleteFromTable('inventory', 'deviceId', $rowId);
  unset($_GET['id']);
  // Rebuild the URL without the 'id' parameter
  $url = strtok($_SERVER["REQUEST_URI"], '?');
  if (!empty($_GET)) {
    $url .= '?' . http_build_query($_GET);
  }
  // Redirect the user to the modified URL
  header("Location: " . $url);
  exit();
}
//////////////
Destroy();
/////////////
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
$res = admin();
nav('common-button', 'common-button', 'common-button', 'bg-onclick', 'common-button', 'common-button', 'common-button', $res)
?>
<div class="container mt-5">
  <?php
  $Sh = new retrieveData;
  $result = $Sh->retrieveData('inventory', '*');
  //          $Sh->tableDelete1($result,"","","","deviceId");

  ?>
  <div class="row d-flex justify-content-center ">
    <h3 class="m-auto">INVENTORY LIST</h3>
    <?php
    while ($ro = mysqli_fetch_assoc($result)) {
      $imageDataEncoded = base64_encode($ro['image']);
      $dataUri = "data:image/jpeg;base64," . $imageDataEncoded;
      $x = $ro['deviceId'];
      // echo $x;
      echo '<div class="col-3 m-2 card">
                              <img class="w-50 h-50 m-auto mt-2" src=' . $dataUri . ' alt="Blob Image">
                              <div class="card-body">
                                        <h4 class="card-title"> ' . $ro['deviceName'] . '</h4>
                                        <h6>DEVICE-ID :' . $ro['deviceId'] . '</h6>
                                        <h6>DOB :' . $ro['date'] . '</h6>
                                        <h6>EMPLOYEE ID :' . $ro['assignedTo'] . '</h6>
                                        <h6>STATUS :' . $ro['remark'] . '</h6>
                                        <h6>ASSIGNED DATE :' . $ro['assignedDate'] . '</h6>';
      echo " <a class='btn btn-danger' href='?id=$x'  onclick='showAlert(event)'>REMOVE INVENTORY</a>

                              </div>
                    </div>";
    }
    ?>
  </div>
</div>
<script>
  function showAlert(event) {
    event.preventDefault(); // Prevent the default behavior of the anchor tag
    // Access the URL parameters
    var urlParams = new URLSearchParams(event.target.getAttribute("href"));
    var paramValue = urlParams.get('id');
    // console.log(paramValue)
    var result = confirm("Are you sure you want to perform this action?");
    if (result) {
      event.target.href = "?id=" + paramValue;
      window.location.href = event.target.href;
    }
  }
</script>