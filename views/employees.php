<?php

use inventory\login1;
use inventory\insert;
use function inventory\addImg;

// use inventory\update;
require 'C:\xampp\htdocs\INVENTORYPHP\namespace\inventory.php';
require 'C:\xampp\htdocs\INVENTORYPHP\views\logo_common.php';
//////////////
Destroy();
/////////////
$session = $_SESSION['employee'];
logoimg(); ///for logo display/////////
$s = new login1('employees', $session['emailid'], "");
$ro = $s->fetchDetails();
$s = $ro['id'];
///////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
      $username = $_POST['name'];
      $mobilenumber = $_POST['mobilenumber'];
      $emailid = $_POST['emailid'];
      $image = $_POST['image'];
      global $connection;
      addImg($image, $s);
      $query = "UPDATE employees
          SET name = '$username', mobilenumber = '$mobilenumber', emailid = '$emailid'
          WHERE id = $s";
      if ($connection->query($query) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>
                !updated successfully!
               </div>";
      } else {
            echo "<div class='alert alert-danger' role='alert'>
       !failed to update!
       </div>" . mysqli_error($connection);
      }
      // Close the connection
      $connection->close();
}

//////////////////////////////////
$imageDataEncoded = base64_encode($ro['image']);
$dataUri = "data:image/jpeg;base64," . $imageDataEncoded;
////////////////////////////  navbar////////////////////////
////////callling popup*//////////////////
navEmployee('bg-onclick', 'common-button', 'common-button', 'common-button');
?>
<!-- for add emp -->
<div class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center mt-1">
      <div class="col">
            <div class="card">
                  <img class="w-50 h-50 m-auto mt-3" src="<?php echo $dataUri; ?>" alt="Employee Image">
                  <div class="card-body">
                        <h4 class="card-title"><?php echo $ro['name'] ?></h4>
                        <h6><?php echo 'EMPLOYEE-ID: ' . $ro['id'] ?></h6>
                        <h6><?php echo 'MOBILE NUMBER: ' . $ro['mobilenumber'] ?></h6>
                        <h6><?php echo 'EMAIL-ID: ' . $ro['emailid'] ?></h6>
                        <h6><?php echo 'BRANCH: ' . $ro['branch'] ?></h6>
                  </div>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary col-4 m-auto mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        EDIT
                  </button>
                  <!-- M/////////////////////////////////////////////////////odal////////////////////////////////////////////////////////// -->


                  <?php
                  if (isset($_POST['submit1'])) {
                        $ins = new insert;
                        $res = $ins->insertInto('notifications', 'request', 'employeeId', 'permission', $s);
                        if ($res) {
                              echo "<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>SUCCESS!</strong>request send for edit details successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
                        }
                  }
                  $se = $session['id'];
                  $qpop = "SELECT * FROM notifications WHERE employeeId=$se AND accept IS NOT NULL";
                  global $connection;
                  $resultpop = mysqli_query($connection, $qpop);
                  $rowpop = mysqli_num_rows($resultpop);
                  if ($rowpop == 0) {
                        echo '
                              <div class="modal fade " id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                                  <div class="modal-content">
                                                            <div class="modal-header">
                                                                      <h1 class="modal-title fs-5"
                                                                                id="exampleModalLabel">UPDATE</h1>
                                                                      <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                   
                                                                      <form method="post">


                                                                                <div class="mb-3">
                                                                                          <label for="exampleInputEmail1"
                                                                                                    id="button_label"
                                                                                                    class="form-label">NAME</label>
                                                                                          <input name="name" type="text"
                                                                                                    class="form-control"
                                                                                                    id="exampleInputEmail1"
                                                                                                    aria-describedby="emailHelp"
                                                                                                    placeholder="employee name"
                                                                                                    value=' . $ro["name"] . '
                              required disabled>
                    </div>
                    <div class="mb-3">
                              <label for="exampleInputEmail1" id="button_label" class="form-label">MOBILE
                                        NUMBER</label>
                              <input name="mobilenumber" type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="employee mibile number"
                                        value=' . $ro["mobilenumber"] . ' required disabled>
                    </div>
                    <div class="mb-3">
                              <label for="exampleInputEmail1" id="button_label" class="form-label">EMAIL
                                        ID</label>
                              <input name="emailid" type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="employee email id"
                                        value=' . $ro["emailid"] . ' required disabled>
                    </div>
                    <div class="mb-3">
                              <label for="formFileSm" class="form-label">PLEASE
                                        ATTACH YOUR
                                        IMAGE</label>
                              <input name="image" class="form-control form-control-sm" id="formFileSm" type="file"
                                        accept="image/jpeg, image/png, image/gif,image/jpg" disabled>

                    </div>
                    <?php checkBox()?>

                    </div>
                    <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button name="submit1" type="submit" class="btn btn-primary">ASK PERMISSION</button>
                    </div>
          </div>
</div>
</div>';
                  } else {
                        echo '
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                    <div class="modal-content">
                              <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body ">

                                        <form method="post">


                                                  <div class="mb-3">
                                                            <label for="exampleInputEmail1" id="button_label"
                                                                      class="form-label">NAME</label>
                                                            <input name="name" type="text" class="form-control"
                                                                      id="exampleInputEmail1"
                                                                      aria-describedby="emailHelp"
                                                                      placeholder="employee name"
                                                                      value=' . $ro["name"] . ' required>
                                                  </div>
                                                  <div class="mb-3">
                                                            <label for="exampleInputEmail1" id="button_label"
                                                                      class="form-label">MOBILE
                                                                      NUMBER</label>
                                                            <input name="mobilenumber" type="text" class="form-control"
                                                                      id="exampleInputEmail1"
                                                                      aria-describedby="emailHelp"
                                                                      placeholder="employee mibile number"
                                                                      value=' . $ro["mobilenumber"] . ' required>
                                                  </div>
                                                  <div class="mb-3">
                                                            <label for="exampleInputEmail1" id="button_label"
                                                                      class="form-label">EMAIL
                                                                      ID</label>
                                                            <input name="emailid" type="email" class="form-control"
                                                                      id="exampleInputEmail1"
                                                                      aria-describedby="emailHelp"
                                                                      placeholder="employee email id"
                                                                      value=' . $ro["emailid"] . ' required>
                                                  </div>
                                                  <div class="mb-3">
                                                            <label for="formFileSm" class="form-label">PLEASE
                                                                      ATTACH YOUR
                                                                      IMAGE</label>
                                                            <input name="image" class="form-control form-control-sm"
                                                                      id="formFileSm" type="file"
                                                                      accept="image/jpeg, image/png, image/gif,image/jpg">

                                                  </div>
                                                  <?php checkBox()?>

                              </div>
                              <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Close</button>
                                        <button name="submit" type="submit" class="btn btn-primary">update
                                                  details</button>
                              </div>
                    </div>
          </div>
</div>';
                  }

                  ?>
                  <!-- hdhdhd -->
            </div>
      </div>
</div>
<script>
      const myModal = new bootstrap.Modal('#exampleModal', {
            keyboard: false
      })
</script>