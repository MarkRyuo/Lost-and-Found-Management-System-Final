<?php

session_start();
require_once('db.php');

// I-check kung may session variable na 'login_attempts'
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0; // Kung wala, itakda ang initial na bilang ng login attempts sa 0
}

// I-check kung POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare('SELECT * FROM security_lostnfound WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        // Assuming you retrieve full name from the database query
        $_SESSION['usersign'] = $user['usersign'];

        // Reset login attempts upon successful login
        $_SESSION['login_attempts'] = 0;

        // Redirect based on the user's role
        if ($user['role'] === 'admin') {
            header('Location: ../User-Profile/userProfile.php');
        } else {
            header('Location: ../UserProfile Security/userProfileSecurity.php');
        }
        exit;
    } else {
        // Increase login attempts
        $_SESSION['login_attempts']++;

        // Check if login attempts exceed the limit (e.g., 2 attempts)
        if ($_SESSION['login_attempts'] >= 3) {
            echo "<script>alert('Account is blocked due to multiple failed login attempts');</script>";
            exit;
        }

        echo "<script>alert('Invalid username or password');</script>";
    }

    $stmt->close();
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
    <title>Signin Security | Lost and Found</title>
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
