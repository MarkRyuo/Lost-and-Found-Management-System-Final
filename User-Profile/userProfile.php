<?php
session_start();
require_once('db.php'); // Include the database connection file

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
    <title>Admin System</title>
</head>
<body>

<aside>
  <!-- Todo  -->
</aside>

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

        <a href="/This id Final/Register.html">Register</a>
      </form>
    </section>
</body>
</html>

