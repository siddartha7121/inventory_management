<?php

use inventory\inventoryLoss;
use inventory\retrieveData;
use inventory\deleteRow;
use inventory\update;
use function inventory\commonretrive;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
//////////////
Destroy();
/////////////////////
if (isset($_GET['id'])) {
  $rowId = $_GET['id'];
  $s = new deleteRow;
  $res = $s->deleteFromTable('inventory', 'deviceId', $rowId);
  if ($res) {
    echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> deleted lost item successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  } else {
    echo "<div class='alert alert-danger' role='alert'>
    !failed to delete!
    </div>" . mysqli_error($connection);
  }
}
if (isset($_POST['submit'])) {
  $deviceId = $_POST['deviceId'];
  $amount = $_POST['amount'];
  global $connection;
  ////////////////////////getting employee id assigned date by device id////////
  // $query1 = "SELECT assignedDate,assignedTo FROM inventory WHERE deviceId=$deviceId ";
  //            $result1 = mysqli_query($connection, $query1);
  $result1 = commonretrive('inventory', 'deviceId', $deviceId);
  $rowr = mysqli_fetch_assoc($result1);
  $date = $rowr['assignedDate'];
  $employeeid = $rowr['assignedTo'];
  /////////////////////getting emailid by using employee id//////////////////////
  // $query = "SELECT emailid FROM employees WHERE id=$employeeid";
  // $result = mysqli_query($connection, $query);
  $result = commonretrive('employees', 'id', $employeeid);
  $row = mysqli_fetch_assoc($result);
  /////////////////////////posing fine by using cur date//////////////////////////
  $currentDate = date("Y-m-d");
  $date2 = new DateTime($date);
  $date1 = new DateTime($currentDate);
  $interval = $date1->diff($date2);
  $days = $interval->format('%a');
  echo $days;
  // //////////////penalty +fine+update penalty column/////////////////////
  if ($days >= 3) {
    $fine = ($days - 3) * 100;
    $penalty = $amount + $fine;
    $updpenalty = new update;
    $updpenalty->updateTable('inventory', 'penalty', $penalty, 'deviceId', $deviceId);
    $message = "dear employee you lost the orgainaisation proporty so please pay $penalty for the product";
    $head = 'INFANION';
    fsd($row['emailid'], $head, $message);
    echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> email send with penalty successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  } else {
    $updpenalty = new update;
    $updpenalty->updateTable('inventory', 'penalty', $amount, 'deviceId', $deviceId);
    $message = "dear employee you lost the orgainaisation proporty so please pay $amount for the product";
    $head = 'INFANION';
    fsd($row['emailid'], $head, $message);
    echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
            <strong>SUCCESS!</strong> email send with penalty successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
}
/////////////////////////////////////////////////
/////////fro the table/////////////////////////
class my
{
  function  retrieveData()
  {
    global $connection;
    $query = "SELECT deviceId,deviceName,date,assignedTo,remark,assignedDate,penalty FROM inventory WHERE remark IS NOT NULL";
    $result = mysqli_query($connection, $query);
    return $result;
  }
}
//////for popup notifsssss////////////////////////
$re = new inventoryLoss;
$res = $re->popuopnotifications();
logoimg(); ///for logo display/////////
//////////////////////////// for navbar////////////////////////
navHr('common-button', 'common-button', 'bg-onclick', 'common-button', 'common-button', $res[1], $res[0]);
?>
<!-- for table show -->
<div class="container mt-5">
  <h3>LIST OF LOST INVENTORY</h3>
  <?php
  $my = new my;
  $result = $my->retrieveData();
  $my1 = new retrieveData;
  $my1->tableDelete1($result, 'delete', 'remove', '', 'deviceId');
  // if ($res) {
  //   echo "<div class='alert alert-success alert-dismissible fade show position-absolute' role='alert'>
  //           <strong>SUCCESS!</strong> inventory removed successfully.
  //           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  //       </div>";
  // }

  ?>
</div>
<!-- for form -->
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
    <div class="mb-3 col-6 ">
      <label class="form-label">AMOUNT</label>
      <input name="amount" type="number" class="form-control" placeholder="please enter the amount for the item" required>
    </div>
    <button name="submit" type="submit" class="btn btn-primary">SEND MAIL</button>
  </form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>