

var Back = document.getElementById("Back");

Back.addEventListener("click", function() {
  // Display alert
  var confirmLogout = confirm("Are you sure you want to Back?");
  
  // If the user confirms, redirect to "/index.html"
  if (confirmLogout) {
    window.location.href = "/ViewLost_Student/StudertViewLost.php";
  }
});