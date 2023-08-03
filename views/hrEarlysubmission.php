<?php

use inventory\inventoryLoss;
use inventory\retrieveData;
use inventory\login1;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////
Destroy();
/////////////
class my
{
  function  retrieveData()
  {
    global $connection;
    $query = "SELECT deviceId,deviceName,date,assignedTo,assignedDate FROM inventory WHERE remark IS NULL AND assignedDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
    $result = mysqli_query($connection, $query);
    return $result;
  }
}
if (isset($_GET['id'])) {
  // print_r($_GET);
  $deviceId = $_GET['id'];
  global $connection;
  $query =  "UPDATE inventory SET assignedTo = NULL, assignedDate = NULL,penalty=NULL WHERE deviceId = $deviceId";
  $res = mysqli_query($connection, $query);
  unset($_GET['id']);
  // Rebuild the URL without the 'id' parameter
  $url = strtok($_SERVER["REQUEST_URI"], '?');
  if (!empty($_GET)) {
    $url .= '?' . http_build_query($_GET);
  }
  // Redirect the user to the modified URL
  header("Location: " . $url);
  // exit();
  if ($res) {
    echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> submitted invnbetory successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
}
$re = new inventoryLoss;
$res = $re->popuopnotifications();
$sessiondata = $_SESSION['employee'];
logoimg(); ///for logo display/////////
$s = new login1('employees', $sessiondata['emailid'], "");
$ro = $s->fetchDetails();
$s = $ro['id'];
// print_r($_SESSION);
navHr('common-button', 'bg-onclick', 'common-button', 'common-button', 'common-button', $res[1], $res[0]); ?>
<div class="container mt-5">
  <h3>EMPLOYEES WHO TOOK ITEMS</h3>
  <?php
  $my = new my;
  $result = $my->retrieveData();
  $my1 = new retrieveData;
  $my1->tableDelete1($result, "RETURN", "returned", "", "deviceId");
  ?>
</div>