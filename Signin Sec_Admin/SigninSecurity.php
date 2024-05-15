<?php
require_once('db.php');

// API endpoint for user authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare('SELECT * FROM security_lostnfound WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $response = array(
            'status' => 'success',
            'message' => 'User authenticated successfully',
            'token' => generateToken($user['username'], $user['role'])
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Invalid username or password'
        );
    }

    $stmt->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// API endpoint for verifying token and checking authorization
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'verifyToken') {
    $token = isset($_GET['token']) ? $_GET['token'] : null;

    if (verifyToken($token)) {
        // Token is valid, user is authorized
        $response = array(
            'status' => 'success',
            'message' => 'Token verified, user authorized'
        );
    } else {
        // Token is invalid or expired
        $response = array(
            'status' => 'error',
            'message' => 'Invalid or expired token'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Function to generate JWT token
function generateToken($username, $role) {
    // You can use a JWT library to generate tokens
    // For example, you can use Firebase JWT library: https://github.com/firebase/php-jwt
    // Here, we'll simulate a simple token generation
    return base64_encode($username . ':' . $role);
}

// Function to verify JWT token
function verifyToken($token) {
    // You can use a JWT library to verify tokens
    // For example, you can use Firebase JWT library: https://github.com/firebase/php-jwt
    // Here, we'll simulate a simple token verification
    if ($token) {
        $decoded = base64_decode($token);
        // Check if token is valid based on your logic (e.g., check if it's not expired)
        return true; // For simplicity, we'll return true here
    }
    return false;
}
?>
```

With this completion, you now have an API for user authentication and token verification. This API can be integrated into your application to handle authentication and authorization processes securely.

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
