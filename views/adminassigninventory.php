<?php
// use inventory\inventoryLoss;
use inventory\retrieveData;
use inventory\update;
use function inventory\admin;
use function inventory\commonretrive;

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
    $query = "SELECT deviceId,deviceName FROM inventory WHERE assignedTo IS NULL";
    $result = mysqli_query($connection, $query);
    return $result;
  }
}
if (isset($_POST['submit'])) {
  $did = $_POST['deviceId'];
  $eid = $_POST['employeeid'];
  $date = $_POST['date'];
  $result = commonretrive('employees', 'id', $eid);
  $row = mysqli_fetch_assoc($result);
  if ($row) {
    $o = new update;
    $o->updateTable('inventory', 'assignedTo', "$eid", "deviceId", "$did");
    $res = $o->updateTable('inventory', 'assignedDate', "$date", "deviceId", "$did");
    if ($res) {
      echo "<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>SUCCESS!</strong>invnetory assigned to employee successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    } else {
      echo "<div class='w-100 alert alert-danger alert-dismissible fade show position-absolute' role='alert'>
      <strong>FAILED!</strong>invnetory failed to assign successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" . mysqli_error($connection);
    }
  }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
$res = admin();
nav('common-button', 'common-button', 'common-button', 'common-button', 'bg-onclick', 'common-button', 'common-button', $res);
?>
<div class="container">
  <h3 class="mt-3">AVAILABLE ITEMS</h3>
  <div class="row">
    <div class="col-6 mt-2">
      <?php
      $my = new my;
      $result = $my->retrieveData();
      $my1 = new retrieveData;
      $my1->tableDelete1($result, "", "", "", "deviceId");
      ?>
    </div>

    <div class="col-6 w-50 mt-3">
      <div class="div">
        <h2>ASSIGN DEVICE TO EMPLOYEES</h2>
      </div>
      <form method="post">
        <div class="col-6">
          <label class="form-label mt-3">DEVICE ID</label>
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
        <div class="col-6">
          <label class="form-label mt-3">EMPLOYEE ID</label>
          <select class="form-select" aria-label="Default select example" name="employeeid" required>
            <option value="">SELECT EMPLOYEE ID</option>
            <?php
            global $connection;
            $queryid = 'SELECT id,name FROM employees';
            $resulid = mysqli_query($connection, $queryid);
            while ($rowid = mysqli_fetch_assoc($resulid)) {
              $x = $rowid["id"];
              $y = $rowid["name"];
              echo "<option value='$x' >$x-->$y</option>";
            }
            ?>
          </select>
        </div>
        <div class="mb-3 mt-5">
          <label for="date">Assign date:</label>
          <input type="date" name="date" id="date">
        </div>
        <button name="submit" type="submit" class="btn btn-primary">ASSIGN</button>
    </div>
    </form>
  </div>
</div>
</div>