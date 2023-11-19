<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    header('Location: userProfile.html');
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

