<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare('SELECT * FROM security WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        // Assuming you retrieve full name from the database query
        $_SESSION['full_name'] = $user['full_name'];


        // Redirect based on the user's role
        if ($user['role'] === 'admin') {
            header('Location: ../User-Profile/userProfile.php');
        } else {
            header('Location: security_system.php');
        }
        exit;
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="">
      <title>Signin Seurity | Lost and Found</title>
  </head>
  <body>

      <form id="loginForm" method="post">
         <h1>Signin</h1>
          Username: <input type="text" name="username" required><br>
          Password: <input type="password" name="password" required><br>
          <input type="submit" value="Signin">
      </form>

  </body>
      <script>
        // You can add client-side validation or other functionalities here.
      </script>
</html>
