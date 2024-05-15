<?php
session_start();
require_once('db.php');
require_once('vendor/autoload.php'); // Import PHP JWT library

use \Firebase\JWT\JWT;

// Function to generate JWT token
function generateJWT($username, $role) {
    $payload = [
        "username" => $username,
        "role" => $role,
        "exp" => time() + (60 * 60) // Token expiration time (1 hour)
    ];
    return JWT::encode($payload, "your_secret_key");
}

// Process POST request for authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM security_lostnfound WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Generate JWT token
        $jwtToken = generateJWT($user['username'], $user['role']);

        // Set token in session or response
        $_SESSION['token'] = $jwtToken;

        // Redirect or respond based on user's role
        if ($user['role'] === 'admin') {
            header('Location: ../User-Profile/userProfile.php');
        } else {
            header('Location: ../UserProfile Security/userProfileSecurity.php');
        }
        exit;
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

// Example of protected resource endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SESSION['token'])) {
    // Verify JWT token
    try {
        $decoded = JWT::decode($_SESSION['token'], "your_secret_key", array('HS256'));
        // Access granted, return data or perform action
        echo "Welcome, " . $decoded->username . "!";
    } catch (Exception $e) {
        http_response_code(401);
        echo "Unauthorized";
    }
}
?>


<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="img/x-icon" href="/Assets/Images/Batstatelogo.png">
      <link rel="stylesheet" href="SigninSecurity.css">
      <link rel="stylesheet" href="stylecursor.css">
      <title>Signin Seurity | Lost and Found</title>
  </head>
  <body>

  <div class="container">

    <section class="sec-form">

      <form id="loginForm" method="post" class="Form-Signin">
         <h1>Signin</h1>

         <label for="username">Username:</label>
         <input type="text" name="username" id="username" required><br>

         <label for="password">Password:</label>
         <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Signin" class="sign-btn">
      </form>

    </section>
    
        <div class="blank">
          <div class="sub-blank">
            <img src="Batstatelogo.png" alt="Bsu Logo" style="width: 140px; height: 130px;">
            <h1 style="color: #fff; font-size: 3rem;">Lost and Found</h1>
          </div>
        </div>
  </div>
</body>
      <script>
        // You can add client-side validation or other functionalities here.
      </script>
</html>
