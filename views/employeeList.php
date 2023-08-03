<?php

use inventory\retrieveData;
use inventory\deleteRow;
use function inventory\admin;
// use inventory\retrive;
require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////
Destroy();
/////////////
////////////delete line function call//////////////
if (isset($_GET['id'])) {
  // print_r($_GET);
  $rowId = $_GET['id'];
  $s = new deleteRow;
  $res = $s->deleteFromTable('employees', 'id', $rowId);
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
logoimg(); ///for logo display///////// 
////////////////////////////  navbar////////////////////////
$res = admin();
nav('common-button', 'bg-onclick', 'common-button', 'common-button', 'common-button', 'common-button', 'common-button', $res);
?>
<div class="container mt-5">
  <h3>EMPLOYEES LIST</h3>
  <?php
  $Sh = new retrieveData;
  $result = $Sh->retrieveData('employees', 'id', 'name AS NAME', 'emailid AS EMAIL', 'mobilenumber as NUMBER', 'branch AS BRANCH');
  $Sh->tableDelete1($result, 'DELETE_EMPLOYEES', 'remove', '', 'id');
  //  $Sh->tableDelete('employees', 'id', 'name','emailid','mobilenumber','branch');
  ?>
</div>
<script>
  function showAlert(event) {
    event.preventDefault(); // Prevent the default behavior of the anchor tag
    // Access the URL parameters
    var urlParams = new URLSearchParams(event.target.getAttribute("href"));
    var paramValue = urlParams.get('id');
    var result = confirm("Are you sure you want to perform this action?");
    if (result) {
      event.target.href = "?id=" + paramValue;
      window.location.href = event.target.href;
    }
  }
</script>