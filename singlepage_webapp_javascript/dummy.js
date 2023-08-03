let adminnav = [
  "ADD EMPLOYEE",
  "EMPLOYEE list",
  "ADD INVENTORY",
  "INVENTORY list",
  "ASSIGN INVENTORY",
  "NOTIFICATIONS",
  "LOGOUT",
];
//////for nav bar ////
function list(z) {
  let x = document.getElementById("nav");
  let y = `<ul class="nav bg-light justify-content-center mb-5">${z
    .map(
      (element) =>
        `<li class="nav-item my-2 mx-3"><button class="click d-flex btn common-button">${element}</button></li>`
    )
    .join("")}</ul>`;
  x.innerHTML = y;
}
///////fetch post method/////
function submitForm(event) {
  event.preventDefault(); // Prevent default form submission behavior

  const form = event.target; // Get the form element
  const formData = new FormData(form);
  fetch("example.php?action=addemployees", {
    method: "POST",
    headers: {
      Accept: "application/json", // Tell the server to send JSON data in the response
    },
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      // console.log(response);
      return response.json(); // Parse the JSON response
    })
    .then((data) => {
      // Check the 'success' property in the JSON response
      if (data.success) {
        // Employee added successfully
        displaySuccessMessage(data.message);
      } else {
        displayErrorMessage(data.message);
      }
    })
    .catch((error) => {
      // Handle fetch errors, including "no offline error"
      if (error.message === "Failed to fetch") {
        // Handle the "no offline error"
        console.error("Please check your internet connection.");
      } else {
        // Handle other fetch errors
        console.error("Error fetching data:", error.message);
      }
    });
}
function displaySuccessMessage(message) {
  document.getElementById(
    "alert"
  ).innerHTML = `<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>SUCCESS!</strong> ${message}
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>`;
}
function displayErrorMessage(message) {
  document.getElementById(
    "alert"
  ).innerHTML = `<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>FAILED!</strong> ${message}
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>`;
}
///////repeated for invnetory/////////
function submitForm1(event) {
  event.preventDefault(); // Prevent default form submission behavior

  const form = event.target; // Get the form element
  const formData = new FormData(form);
  fetch("example.php?action=inventory", {
    method: "POST",
    headers: {
      Accept: "application/json", // Tell the server to send JSON data in the response
    },
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      console.log(response);
      return response.json(); // Parse the JSON response
    })
    .then((data) => {
      // Check the 'success' property in the JSON response
      if (data.success) {
        // Employee added successfully
        displaySuccessMessage(data.message);
      } else {
        displayErrorMessage(data.message);
      }
    })
    .catch((error) => {
      // Handle fetch errors, including "no offline error"
      if (error.message === "Failed to fetch") {
        // Handle the "no offline error"
        console.error("Please check your internet connection.");
      } else {
        // Handle other fetch errors
        console.error("Error fetching data:", error.message);
      }
    });
}
function displaySuccessMessage(message) {
  document.getElementById(
    "alert"
  ).innerHTML = `<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>SUCCESS!</strong> ${message}
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>`;
}
function displayErrorMessage(message) {
  document.getElementById(
    "alert"
  ).innerHTML = `<div class='w-100 alert alert-success alert-dismissible fade show position-absolute' role='alert'>
      <strong>FAILED!</strong> ${message}
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>`;
}

////for intaraction fatavbase///////
function fetching(x) {
  document.getElementById("dataContainer").innerHTML = " ";
  var loadingIndicator = document.getElementById("loadingIndicator");
  loadingIndicator.style.display = "block";
  // Send an asynchronous request to a PHP script
  fetch(x)
    .then((response) => response.text())
    .then((data) => {
      // Update the web page with the retrieved data
      var dataContainer = document.getElementById("dataContainer");
      dataContainer.innerHTML = data;
      // Hide the loading indicator
      loadingIndicator.style.display = "none";
    })
    .catch((error) => {
      // Handle any errors that occurred during the request
      console.error("Error:", error);
      // Hide the loading indicator and show an error message
      loadingIndicator.style.display = "none";
      var dataContainer = document.getElementById("dataContainer");
      dataContainer.innerHTML = "An error occurred while fetching data.";
    });
}
/////////for popup and delete employees &&inventories
function showAlert(event) {
  event.preventDefault(); // Prevent the default behavior of the anchor tag
  var urlParams = new URLSearchParams(event.currentTarget.getAttribute("href"));
  var paramValue = urlParams.get("id");

  var result = confirm(
    "Are you sure you want to perform delete employee from table?"
  );

  if (result) {
    fetching(`example.php?action=delete&&id=${paramValue}`);
    // fetching("example.php?action=table");
    document.getElementsByClassName("click")[1].click();
  }
}
//////////////calling functions based on pages requirement////////
document.addEventListener("DOMContentLoaded", function () {
  if (window.location.href.includes("zzzzzzzzz.php")) {
    list(adminnav);
    //////////listing employees///////////
    let employeelist = this.documentElement.getElementsByClassName("click")[1];
    employeelist.addEventListener("click", function () {
      fetching("example.php?action=table");
      employeelist.classList.remove("common-button");
      employeelist.classList.add("bg-onclick");
    });
    //////////////adding employees//////////
    // document.addEventListener("DOMContentLoaded", function () {
    const addEmployeesButton = document.getElementsByClassName("click")[0];
    addEmployeesButton.addEventListener("click", function () {
      let x = `<div class="container w-50">
          <div class="div">
            <h2>ADD EMPLOYEE</h2>
          </div>
          <form id='myForm'>
            <div class="mb-1">
              <label for="exampleInputEmail1" id="button_label" class="form-label">NAME</label>
              <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="employee name" required>
            </div>
            <div class="mb-3">
              <label id="button_label" class="form-label">MOBILE NUMBER</label>
              <p class="span" id="numb"></p>
              <input name="mobilenumber" type="number" class="form-control" id="exampleInputmobilenumber" aria-describedby="emailHelp" placeholder="employee mobile number" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" id="button_label" class="form-label">EMAIL ID</label>
              <input name="emailid" type="email" class="form-control" id="exampleInputEmail11" aria-describedby="emailHelp" placeholder="employee email id" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <p class="span" id="pasval"></p>
              <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="password" required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Branch</label>
              <select class="form-select" aria-label="Default select example" name="branch" required>
                <option>select employee branch</option>
                <option value="1">EMPLOYEE</option>
                <option value="2">HR</option>
              </select>
            </div>
            <?php checkBox() ?>
            <button id="login" name="submit" type="submit" class="btn btn-primary">ADD NEW EMPLOYEE</button>
          </form>
        </div>`;

      document.getElementById("dataContainer").innerHTML = x;

      const form = document.getElementById("myForm");
      form.addEventListener("submit", submitForm);
    });
    //////////////////Adding data or database fetching API/////
    const addInventory = document.getElementsByClassName("click")[2];
    addInventory.addEventListener("click", function () {
      let x = `<div class="container w-50">
      <div class="div">
        <h2>ADD NEW DEVICE</h2>
      </div>
      <form id="myForm">
        <div class="mb-3">
          <label for="exampleInputEmail1" id="button_label" class="form-label">DEVICE NAME</label>
          <input name="devicename" type="text" class="form-control" id="exampleInputEmail1"
            placeholder="please enter the new device name" required>
        </div>
        <div class="mb-3">
          <label for="formFileSm" class="form-label">PLEASE ATTACH DEVICE IMAGE</label>
          <input name="image12" class="form-control form-control-sm" id="formFileSm" type="file"
            accept="image/jpeg, image/png, image/gif,image/jpg">
        </div>
        <button name="submit" type="submit" class="btn btn-primary">ASSIGN</button>
      </form>
    </div>`;
      document.getElementById("dataContainer").innerHTML = x;
      const form = document.getElementById("myForm");
      form.addEventListener("submit", submitForm1);
    });
  }
});
