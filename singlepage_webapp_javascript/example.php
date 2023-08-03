<?php

use inventory\retrieveData;
use inventory\deleteRow;
use function inventory\admin;
use inventory\retrive;
use inventory\insert;
use inventory\login1;

require 'C:\xampp\htdocs\mysqlConnectionPHP\send_email.php';
require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
$Sh = new retrieveData;
$result = $Sh->retrieveData('employees', 'id', 'name AS NAME', 'emailid AS EMAIL', 'mobilenumber as NUMBER', 'branch AS BRANCH');
if ($_GET['action'] == 'table') {
  echo '<h3>EMPLOYEES LIST</h3>';
  $s = new retrieveData;
  $s->tableDelete1($result, 'DELETE_EMPLOYEES', 'remove', '', 'id');
  usleep(1000000); // Sleep for 1 seconds
}
if ($_GET['action'] == 'delete' && $_GET['id']) {
  $rowId = $_GET['id'];
  $s = new deleteRow;
  $res = $s->deleteFromTable('employees', 'id', $rowId);
}

if ($_GET['action'] == 'addemployees') {
  $userid = $_POST['name'];
  $password = $_POST['password'];
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $mobilenumber = $_POST['mobilenumber'];
  $emailid = $_POST['emailid'];
  $branch = $_POST['branch'];
  $ch = new login1('employees', $emailid, '');
  $row = $ch->fetchDetails();
  if (!$row) {
    $o = new insert;
    $result = $o->insertInto(
      'employees',
      'name',
      'password',
      'mobilenumber',
      'emailid',
      'branch',
      "$userid",
      "$hashedPassword",
      "$mobilenumber",
      "$emailid",
      "$branch"
    );
    // Create a response array
    $response = array();
    // If the operation was successful
    $response['success'] = true;
    // $responseData = array('message' => 'Hello from the server-side!');
    $response['message'] = 'Employee added successfully.';
    // Send the response back as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  } else {
    // Create a response array
    $response = array();
    // If the operation was successful
    $response['success'] = false;
    // $responseData = array('message' => 'Hello from the server-side!');
    $response['message'] = 'Employee failed to add ';
    // Send the response back as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }
}
if ($_GET['action'] == 'inventory') {
  $devicename = $_POST['devicename'];
  $image = $_POST['image12'];
  $stmt = "C:\Users\siddu\Downloads/";
  $path = $stmt . $image;
  // echo $path;
  $updatedFileContents = file_get_contents("$path");
  global $connection;
  $query = "INSERT INTO inventory (deviceName, image) VALUES (?, ?)";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $devicename, $updatedFileContents);
  // Execute the prepared statement
  $res = mysqli_stmt_execute($stmt);
  if ($res) {
    // Create a response array
    $response = array();
    // If the operation was successful
    $response['success'] = true;
    // $responseData = array('message' => 'Hello from the server-side!');
    $response['message'] = 'Employee added successfully.';
    // Send the response back as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  } else {
    // Create a response array
    $response = array();
    // If the operation was successful
    $response['success'] = false;
    // $responseData = array('message' => 'Hello from the server-side!');
    $response['message'] = 'Employee failed to add ';
    // Send the response back as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }
}
