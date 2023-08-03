<?php

use inventory\insert;
use inventory\update;
use function inventory\admin;
use function inventory\commonretrive;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////
Destroy();
print_r($_SESSION);
$emp = $_SESSION['employee'];
/////////////
if (isset($_GET['id'])) {

    $in = new insert;
    $res = $in->insertInto('notifications', 'request', 'employeeId', 'deviceId', 'assign', $emp['id'], $_GET['id']);
    if ($res) {
        echo "<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>SUCCESS!</strong>invnetory assigned riquested successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
}
class my
{
    function  retrieveData()
    {
        global $connection;
        $query = "SELECT * FROM inventory WHERE assignedTo IS NULL";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
navEmployee('common-button', 'bg-onclick', 'common-button', 'common-button'); ?>
<div class="row d-flex justify-content-center ">
    <?php
    $r = new my;
    $result = $r->retrieveData();
    while ($ro = mysqli_fetch_assoc($result)) {
        $imageDataEncoded = base64_encode($ro['image']);
        $dataUri = "data:image/jpeg;base64," . $imageDataEncoded;
        $x = $ro['deviceId'];
        echo '<div class="col-3 m-2 card">
                              <img class="w-50 h-50 m-auto mt-2" src=' . $dataUri . ' alt="Blob Image">
                              <div class="card-body">
                                        <h4 class="card-title"> ' . $ro['deviceName'] . '</h4>
                                        <h6>DEVICE-ID :' . $ro['deviceId'] . '</h6>
                                        <h6>DOB :' . $ro['date'] . '</h6>
                                        <h6>EMPLOYEE ID :' . $ro['assignedTo'] . '</h6>
                                        <h6>STATUS :' . $ro['remark'] . '</h6>
                                        <h6>PENALTY :' . $ro['penalty'] . '</h6>
                                        <h6>ASSIGNED DATE :' . $ro['assignedDate'] . '</h6>';
        echo " <a href='?id=$x'><button class=' rounded common-button'>REQUEST INVENTORY</button></a>
                              </div>
                    </div>";
    }
    ?>
</div>
</div>