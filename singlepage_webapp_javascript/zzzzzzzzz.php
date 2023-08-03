<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
          <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
          <link rel="stylesheet" href="../common_css/index.css">
          <title>Inventory</title>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <script src="dummy.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0">
          <div id="alert"></div>
          <!-- logo of product -->
          <div class="container mb-3">
                    <div class="row d-flex justify-content-center">
                              <div class="col-5">
                                        <a href="main.php"><img id="logo" src="https://www.infanion.com/sites/default/files/Infanion_logo.png" alt="logo of infanion"></a>
                              </div>
                    </div>
          </div>
          <div id="nav"></div>
          <div class="container">
                    <div id="loadingIndicator" style="display: none;">
                              <div class="d-flex justify-content-center mt-1">
                                        <div class="spinner-border text-dark" role="status">
                                                  <span class="visually-hidden">Loading...</span>
                                        </div>
                              </div>
                    </div>
                    <div id="dataContainer"></div>
          </div>