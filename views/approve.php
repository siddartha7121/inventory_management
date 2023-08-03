<?php

use function inventory\admin;
use function inventory\commonquery;
use function inventory\commonretrive;

use  inventory\retrieveData;
use  inventory\deleteRow;
use  inventory\update;

require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////
Destroy();
/////////////
if (isset($_GET['id'])) {
  $rowId = $_GET['id'];
  $s = new deleteRow;
  $res = $s->deleteFromTable('notifications', 'id', $rowId);
  if ($res) {
    echo "<div class='alert alert-success' role='alert'>
                    !removed successfully!
                   </div>";
  } else {
    echo "<div class='alert alert-danger' role='alert'>
           !failed to remove!
           </div>" . mysqli_error($connection);
  }
}
if (isset($_POST['submit'])) {
  $deviceId = $_POST['sub'];
  $app = commonretrive('notifications', 'id', $deviceId);
  $appfet = mysqli_fetch_assoc($app);
  if ($appfet['request'] == 'permission') {
    $grt = new update;
    $res = $grt->updateTable('notifications', 'accept', 'grant', 'id', $deviceId);
    if ($res) {
      echo "<div class='alert alert-success' role='alert'>
                       !updated successfully!
                      </div>";
    } else {
      echo "<div class='alert alert-danger' role='alert'>
               !failed to update!
               </div>" . mysqli_error($connection);
    }
  } else {
    $eid = $appfet['employeeId'];
    $did = $appfet['deviceId'];
    $date = date('Y-m-d');
    $id = $appfet['id'];
    $o = new update;
    $o->updateTable('inventory', 'assignedTo', "$eid", "deviceId", "$did");
    $res = $o->updateTable('inventory', 'assignedDate', "$date", "deviceId", "$did");
    $s = new deleteRow;
    $res = $s->deleteFromTable('notifications', 'id', $id);
  }
}
logoimg(); ///for logo display/////////
////////////////////////////  navbar////////////////////////
$res = admin();
nav('common-button', 'common-button', 'common-button', 'common-button', 'common-button', 'bg-onclick', 'common-button', $res);
?>
<div class="container mt-5">
  <?php
  $result = commonquery('notifications');
  $tab = new retrieveData;
  $tab->tableDelete1($result, "remove_access", "revok", "", "id");
  ?>
</div>
<div class="container">
  <form method="post">
    <div class="col-6">
      <label class="form-label mt-3">REQUEST ID</label>
      <select class="form-select" aria-label="Default select example" name="sub" required>
        <option value="">SELECT ID</option>
        <?php $resulid = commonquery('notifications');
        while ($rowid = mysqli_fetch_assoc($resulid)) {
          $x = $rowid["id"];
          $y = $rowid["request"];
          echo "<option value='$x' >$x-->$y</option>";
        }
        ?>
      </select>
    </div>
    <button name="submit" type="submit" class="btn btn-primary mt-3">GRANT</button>
  </form>
</div>