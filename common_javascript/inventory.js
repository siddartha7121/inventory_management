//////////////this is onload function for every page//////
//////based on page functions called on these function////
window.addEventListener("load", function() {
if (window.location.href.includes('employeeLogin.php')||window.location.href.includes('adminLogin.php')||window.location.href.includes('login.php')) {
  console.log('working');
  loginvalidations();
  hidepassword();
  keypress(0);
  keypress(1);
  radio(0,'admin','employee');
  radio(1,'employee','admin');
}
if(window.location.href.includes('adminAddEmp.php')){
  loginvalidations();
  notifications();
      document.getElementById("exampleInputmobilenumber").addEventListener("blur", function() {
      let num = document.getElementById("exampleInputmobilenumber").value;
      if (num.length < 10) {
        document.getElementById('numb').innerHTML = "Number must have a minimum length of 10 digits";
        document.getElementById('login').disabled = true;
      } else {
        document.getElementById('numb').innerHTML = "";
        document.getElementById('login').disabled = false;
      }
    });
}
if(window.location.href.includes('employeeList.php')||window.location.href.includes('addinventory.php')||window.location.href.includes('listInventory.php')||window.location.href.includes('adminassigninventory.php')||window.location.href.includes('approve.php')||location.href.includes('listInventory.php')||location.href.includes('hrinventoryLoss.php')||location.href.includes('hr.php')||location.href.includes('hrLatesub.php')||location.href.includes('hrEarlysubmission.php')){
  notifications();
}
if(window.location.href.includes('otp.php')){
  otp();
}
})
//////////////////employee admin validations////////
function loginvalidations(){
  document.getElementById('pasval').style.opacity=0;
  let x = document.getElementById('exampleInputPassword1');
  x.addEventListener("keyup", function() {
    let z = document.getElementById('exampleInputPassword1').value;
    let length = z.length;
    if (length < 8) {
      document.getElementById('pasval').style.opacity=1;
      document.getElementById('login').disabled = true;
    } else {
      document.getElementById('pasval').style.opacity=0;
      document.getElementById('login').disabled = false;
    }
  });
}
////////////notifications popup null /////////////////
function notifications(){
    let notval = document.getElementById("notifications").innerText;
if (notval == 0) {
    document.getElementById("notifications").style.display = "none";
    console.log(notval);
} else {
    document.getElementById("notifications").style.display = "block";
    console.log(notval);
}
}
/////////////show notifications alert////////////////////
// function showAlert(event) {
//   event.preventDefault(); // Prevent the default behavior of the anchor tag
//   var urlParams = new URLSearchParams(event.currentTarget.getAttribute("href"));
//   var paramValue = urlParams.get('id');
  
//   var result = confirm("Are you sure you want to perform delete employee from table?");
  
//   if (result) {
//     event.currentTarget.href = "?id=" + paramValue;
//     window.location.href = event.currentTarget.href;
//   }
// }
////////otp time out function//////////
function otp(){
   let count = 60;
            let s = setInterval(f, 1000)

            function f() {
                  if (count > 0) {
                        count--;
                        document.getElementById('siddu').innerHTML = count;
                  } else {
                        document.getElementById('siddu').innerHTML = 'otp expiered';
                        window.location.href = "main.php";
                        clearInterval(s);
                  }
            }
}
///////////////////password display hide/////////
function hidepassword(){
  document.getElementById('display').addEventListener('click',function(){
    document.getElementById('hide').removeAttribute("hidden");
    document.getElementById('display').setAttribute("hidden", true);
    document.getElementById('exampleInputPassword1').type='text';
  })
  document.getElementById('hide').addEventListener('click',function(){
    document.getElementById('display').removeAttribute("hidden");
    document.getElementById('hide').setAttribute("hidden", true);
    document.getElementById('exampleInputPassword1').type='password';
  })
}
/////////////////form events*////////////////////
function keypress(a){
  let s= document.getElementsByClassName('posiitioninput')[a];
  let t=s.value;
  document.getElementsByClassName('posiitioninput')[a].addEventListener('keyup',function(){
     t=s.value;
    let x=document.getElementsByClassName('lable')[a];
    if(t!=''){
    x.style.transform = 'translate(14px,0)';
    x.style.opacity=1;
    console.log(t)}
       else{
    x.style.transform = 'translate(14px,39px)';
       }
  })
}
////////////radion display//////////////
function radio(x,y,z){
  document.getElementsByClassName('radio')[x].addEventListener('click',function(){
    document.getElementById(y).style.opacity=1;
    document.getElementById(z).style.opacity=0;
    document.getElementById('log').style.opacity=0;
  })
}
