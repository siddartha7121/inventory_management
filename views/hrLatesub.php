<?php

use inventory\inventoryLoss;
use inventory\retrieveData;
use inventory\update;
use function inventory\commonretrive;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
//////////////
Destroy();
/////////////
class my
{
  function  retrieveData()
  {
    global $connection;
    $query = "SELECT deviceId,deviceName,date,assignedTo,remark,assignedDate,penalty FROM inventory WHERE remark IS NULL AND assignedDate <= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
    $result = mysqli_query($connection, $query);
    return $result;
  }
}

////////////////////////////////
if (isset($_GET['id'])) {
  $deviceid = $_GET['id'];
  global $connection;
  ////////////////////////////////
  //  $query1 = "SELECT assignedDate,assignedTo FROM inventory WHERE deviceId=$deviceid ";
  //  $result1 = mysqli_query($connection, $query1);
  $result1 = commonretrive('inventory', 'deviceId', $deviceid);
  $rowr = mysqli_fetch_assoc($result1);
  $date = $rowr['assignedDate'];
  $currentDate = date("Y-m-d");
  $date2 = new DateTime($date);
  $date1 = new DateTime($currentDate);
  $interval = $date1->diff($date2);
  $days = $interval->format('%a');
  echo $days;
  if ($days >= 3) {
    $fine = ($days - 3) * 100;
    $employeeid = $rowr['assignedTo'];
    ///////////////////////update penalty column///////////////////
    $updpenalty = new update;
    $updpenalty->updateTable('inventory', 'penalty', $fine, 'deviceId', $deviceid);
    ///////////////////find email id if assigned device/////////////////// 
    $result = commonretrive('employees', 'id', $employeeid);

    $row = mysqli_fetch_assoc($result);
    $message = "you failed to submit the office proporty intime you will charged fine $fine if u failed to submit inventory you will charged 100re fine a day";
    $head = 'INFANION';
    fsd($row['emailid'], $head, $message);
    if ($row) {
      echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> item penalty mail send successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
      echo "<div class='alert alert-danger' role='alert'>
              !failed to send mail!
              </div>" . mysqli_error($connection);
    }
  }
}
//////////////////////////////////////
if (isset($_POST['submit'])) {
  global $connection;
  $deviceId = $_POST['deviceId'];
  $query =  "UPDATE inventory SET assignedTo = NULL, assignedDate = NULL,penalty=NULL WHERE deviceId = $deviceId";
  $res = mysqli_query($connection, $query);
  if ($res) {
    echo "<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> item submitted with penalty successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  } else {
    echo "<div class='w-100 alert alert-danger' role='alert'>
          !failed to update!
          </div>" . mysqli_error($connection);
  }
}
////////////////////////////////
logoimg(); ///for logo display/////////
//////for popup notifsssss////////////////////////
$re = new inventoryLoss;
$res = $re->popuopnotifications();
////////////////////////////  navbar////////////////////////
navHr('common-button', 'common-button', 'common-button', 'bg-onclick', 'common-button', $res[1], $res[0]);
?>
<div class="container mt-5">
  <?php
  $my = new my;
  $result = $my->retrieveData();
  $my1 = new retrieveData;
  $my1->tableDelete1($result, "FINE", "sent-mail", "", "deviceId");
  ?>
</div>
<!--  -->
<div class="container">
  <form method="post">
    <div class="col-6">
      <label class="form-label mt-3">EMPLOYEE ID</label>
      <select class="form-select" aria-label="Default select example" name="deviceId" required>
        <option value="">SELECT INVENTORY ID</option>
        <?php $my = new my;
        $resulid = $my->retrieveData();
        while ($rowid = mysqli_fetch_assoc($resulid)) {
          $x = $rowid["deviceId"];
          $y = $rowid["deviceName"];
          echo "<option value='$x' >$x-->$y</option>";
        }
        ?>
      </select>
    </div>
    <button name="submit" type="submit" class="btn btn-primary mt-3">UPDATE TABLE</button>
  </form>
</div>