<?php
session_start();
require_once('Database.php'); // Include the database connection file

if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    // Redirect if the user is not an admin
    header('Location: security_system.php');
    exit;
}

// Retrieve user information from the session
$username = $_SESSION['username'];
$fullName = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/Aside-Nav/Aside.css">
    <link rel="stylesheet" href="/User-Profile/Userprofile.css">
    <title>User Profile | Lost and Found</title>
</head>
<body>

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
    <!-- End of Aside -->

  <main class="main-User">
    <!-- header here -->
    <header>
      <nav class="parent-Nav">
        <h1><span><i class="fa-solid fa-user-shield fa-beat-fade"></i></span>User Profile</h1>
      </nav>
    </header>

    <!--Section Here  -->
    <section class="parent-User">
      
        <div class="user-button-Log-out">
          <button id="Logout" class="box btn-color-Logout">
            <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
            Logout  <!--This is Text Logout-->
          </button> 
        </div>
        
      <form class="input">
        <h2>Welcome Admin!</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($fullName); ?>" readonly>

        <a href="/This id Final/Register.html">Register</a> <!--Todo -->
      </form>

    </section>

  </main>
</body>
  <script src="/assets/Aside-Nav/btn-aside.js"></script>
</html>

