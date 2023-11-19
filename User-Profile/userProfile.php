<?php
session_start();
require_once('Database.php'); // Include the database connection file

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

