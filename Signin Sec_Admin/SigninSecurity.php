<?php
session_start();
require_once('Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        // Assuming you retrieve Name from the database query
        $_SESSION['name'] = $user['name'];


        // Redirect based on the user's Role
        if ($user['role'] === 'admin') {
            header('Location: admin_system.php'); //Todo Link here the Location of admin
        } else {
            header('Location: /User-Profile/userProfile.php'); //Todo Link here the Location of Security
        }
        exit;
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

?>
