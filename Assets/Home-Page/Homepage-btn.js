/*Need ng Alert dito*/


// studentSignin btn 

var studentSignin = document.getElementById("studentSignin");

studentSignin.addEventListener("click", function() {
  window.location.href = "/Student/Studentsignin.php";
});

// securitySignin btn
var securitySignin = document.getElementById("securitySignin");

securitySignin.addEventListener("click", function() {
  window.location.href = "/Signin Sec_Admin/SigninSecurity.php";
});

// adminSignin btn 
var adminSignin = document.getElementById("adminSignin");

adminSignin.addEventListener("click", function() {
  window.location.href = "#";
});


