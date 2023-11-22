<?php
// Replace these with your actual database credentials
$host = "localhost";
$dbname = "db_nt3102";
$user = "root";
$password = "";

header('Content-Type: application/json');

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empid = $_POST["empid"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $usersign = $_POST["usersign"];
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $department = $_POST["department"];

    // Perform basic validation
    if (empty($empid) || empty($username) || empty($password) || empty($role) || empty($usersign) || empty($lastname) || empty($firstname) || empty($department)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit();
    }

    // Use SHA-256 for password hashing (you can use your preferred hashing method)
    $hashedPassword = hash('sha256', $password);

    try {
        // Perform SQL insertion into tbemployee
        $sqlEmployee = "INSERT INTO tbemployee (empid, lastname, firstname, department) VALUES (?, ?, ?, ?)";
        $stmtEmployee = $pdo->prepare($sqlEmployee);
        $stmtEmployee->execute([$empid, $lastname, $firstname, $department]);

        // Perform SQL insertion into security_lostnfound
        $sqlsecurity_lostnfound = "INSERT INTO security_lostnfound (UserId, username, password, role, usersign) VALUES (?, ?, ?, ?, ?)";
        $stmtsecurity_lostnfound = $pdo->prepare($sqlsecurity_lostnfound);
        $stmtsecurity_lostnfound->execute([$empid, $username, $hashedPassword, $role, $usersign]);

        echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
