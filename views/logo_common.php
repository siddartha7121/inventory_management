<?php
function logoimg()
{
        echo
        '<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
          <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                    crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
                    crossorigin="anonymous"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
          <link rel="stylesheet" href="../common_css/index.css">
          <title>inventory</title>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <script src="../common_javascript/inventory.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
          <!-- logo of product -->
           <div class="container mb-5">
                    <div class="row d-flex justify-content-center">
                              <div class="col-5">
                                        <a href="main.php"><img id="logo"
                                                  src="https://www.infanion.com/sites/default/files/Infanion_logo.png"
                                                  alt="logo of infanion"></a>
                              </div>
                    </div>
          </div>';
}
////////////////////////link buttons//////////////////
function linkbutton($href, $buttonName)
{
        echo '<a class="nav-link active" href="' . $href . '"><buttontype="button" class="btn bg-onclick mb-5">' . $buttonName . '</buttontype=></a>';
}
///////////////////common input box//////////////////////////////
function checkBox()
{
        echo '<div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
</div>';
}
/////////////////////////nav bar/////////////////
function nav($c1, $c2, $c3, $c4, $c5, $c6, $c7, $res)
{
        echo '<ul class="nav bg-light justify-content-center">
        <li class="nav-item">
        <a class="nav-link active" href="adminAddEmp.php"><buttontype="button" class=" btn ' . $c1 . '">ADD EMPLOYEE</buttontype=></a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="employeeList.php"><buttontype="button" class="btn ' . $c2 . '">EMPLOYEE LIST</buttontype=></a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="addinventory.php"><buttontype="button" class="btn ' . $c3 . '">ADD INVENTORY</buttontype=></a>   
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="listInventory.php"><buttontype="button" class="btn ' . $c4 . '">INVENTORY LIST</buttontype=></a>     
        </li>
        <li class="nav-item"></li>
        <li class="nav-item">
        <a class="nav-link active" href="adminassigninventory.php"><buttontype="button" class="btn ' . $c5 . '">ASSIGN INVENTORY</buttontype=></a> 
        </li> 
        <li class="nav-item">
        <a class="nav-link active" href="approve.php">
        <button type="button" class="btn ' . $c6 . ' position-relative">
        notifications
        <span id="notifications" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        ' . $res . '
        </span>
        </button>
        </a>
</li>

        <li class="nav-item">
        <a class="nav-link active" href="logout.php"><buttontype="button" class="btn ' . $c7 . '">LOG OUT</buttontype=></a>     
        </li>
        <li class="nav-item"></li>
</ul>';
}
///////////////////navbar employee//////////////
function navEmployee($c5, $c4, $c3, $c6)
{
        echo '<ul class="nav bg-light justify-content-center">
        <li class="nav-item">
        <a class="nav-link active" href="employees.php"><buttontype="button" class="btn ' . $c5 . '">EMPLOYEE PROFILE</buttontype=></a> 
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="employeechooseitem.php"><buttontype="button" class="btn ' . $c4 . '">CHOOSE INVENTORY</buttontype=></a>   
        </li>  
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="employeelostitem.php"><buttontype="button" class="btn ' . $c3 . '">LOST</buttontype=></a>   
        </li>

        <li class="nav-item">
        <a class="nav-link active" href="logout.php"><buttontype="button" class="btn ' . $c6 . '">LOG OUT</buttontype=></a>     
        </li>
</ul>';
}
///////////////////navbar hr//////////////////
function navHr($c1, $c5, $c2, $c3, $c4, $res, $res1)
{
        echo '<ul class="nav bg-light justify-content-center">
        <li class="nav-item">
        <a class="nav-link active" href="hr.php"><buttontype="button" class="btn ' . $c1 . '">HR PROFILE</buttontype=></a> <li> 
        <li class="nav-item">
        <a class="nav-link active" href="hrEarlysubmission.php"><buttontype="button" class="btn ' . $c5 . '">EARLY SUMBISSIONS</buttontype=></a> <li> 
        <li class="nav-item">
          <a class="nav-link active" href="hrinventoryLoss.php">
          <button type="button" class="btn ' . $c2 . ' position-relative">
          LOST ITEM
          <span id="notifications" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          ' . $res1 . '
          </span>
          </button>
          </a>
</li>


<li class="nav-item">
          <a class="nav-link active" href="hrLatesub.php">
          <button type="button" class="btn ' . $c3 . ' position-relative">
          LATE SUBMISSION
          <span id="notifications" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          ' . $res . '
          </span>
          </button>
          </a>
</li>
<li class="nav-item">
          <a class="nav-link active" href="logout.php">
                    <buttontype="button" class="btn ' . $c4 . '">LOG OUT</buttontype=>
          </a>
</li>
</ul>';
}
function Destroy()
{
        // Check if the session is empty
        if (empty($_SESSION)) {
                header("Location: main.php");
                exit;
        }
}
