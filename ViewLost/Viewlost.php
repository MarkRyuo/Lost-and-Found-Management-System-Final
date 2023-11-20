<?php
// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt123";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve lost items from the Items table
$sql = "SELECT * FROM Items ";
$result = $conn->query($sql);

?>

<!-- HTML HERE -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="icon" type="img/x-icon" href="/Assets/Images/Batstatelogo.png">
  <!-- This is link for aside -->
  <!-- <link rel="stylesheet" href="/assets/Aside-Nav/Aside.css"> -->
  <link rel="stylesheet" href="/ViewLost_Student/StudentView.css">

  <!-- btn Logout connection -->
  <link rel="stylesheet" href="/assets/css/btn-LogoutView.css">
  <link rel="stylesheet" href="/View Lost Item/View.css">
  <title>View Lost Item|Lost and Found</title>
</head>
<body>

    <!-- This Aside -->
    <aside>
    <!-- Just Wait Here this is navigation but in Left side -->
      <div class="Logo">
        <div class="logo-align">
          <img src="/assets/Images/lost-items-missing-svgrepo-com (1).png" alt="This is Image">
          <h1>
            Lost and Found <br> 
            Management <br>System
          </h1>
        </div>
        <p>General</p>
      </div>

      <nav class="button-Nav">
        <!-- User Profile -->
      <hr>
      <button class="btn" id="User">
          <span class="btn-text-one"><i class="fa-solid fa-user-shield"></i></span>
          <span class="btn-text-two">User Profile</span>
      </button>
      <hr>
      <!-- View Lost Item -->
      <button class="btn" id="viewlostItem">
        <span class="btn-text-one"><i class="fa-regular fa-eye "></i></span>
        <span class="btn-text-two">View Lost Item</span>
      </button>
      <hr>
      <!--Report Missing-->
      <button class="btn" id="reportMissing">
        <span class="btn-text-one"><i class="fa-solid fa-person-circle-question "></i></span>
        <span class="btn-text-two">Report Missing</span>
      </button>
      <hr>
      <!-- Claim Conformation  -->
      <button class="btn" id="claimConformation">
        <span class="btn-text-one"><i class="fa-solid fa-square-check"></i></span>
        <span class="btn-text-two">Claim Conformation</span>
      </button>
      <hr>
    </aside>
      <!-- End of aside -->
      
   <main class="Tables">
          <!-- Header Section -->
     <header class="nav">
      <nav class="parent-Nav">
        <h1><span><i class="fa-solid fa-eye fa-beat-fade"></i></span>View Lost Item</h1>
        <div class="user-button-Log-out">
          <button id="Logout" class="box btn-color-Logout">
            <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
            Logout  <!--This is Text Logout-->
          </button> 
        </div>
      </nav>
    </header>
    
      <!-- Table Here -->
      <?php
  // Display lost items
  if ($result->num_rows > 0) {
      
      echo "<table class='parent-Table'>";
      echo "<tr class='table-Header'>";
      echo "<th>Item ID</th>";
      echo "<th>Item Name</th>";
      echo "<th>Found Date</th>";
      echo "</tr>";

      while ($row = $result->fetch_assoc()) {
          echo "<tr class='table-Data'>";
          echo "<td><input type='text' value='" . $row["ItemID"] . "' readonly></td>";
          echo "<td><input type='text' value='" . $row["ItemName"] . "' readonly></td>";
          echo "<td><input type='text' value='" . $row["FoundDate"] . "' readonly></td>";
          echo "</tr>";
      }

      echo "</table>";
  } else {
      echo "No lost items found.";
  }

  // Close the database connection
  $conn->close();
  ?>

  </main>
</body>
  <!-- connection in aside js -->
  <script src="/assets/Aside-Nav/btn-aside.js"></script>

  <script src="/assets/js/Logout.js"></script>
</html>