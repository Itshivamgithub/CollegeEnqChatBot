<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auth_demo");

// Show errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get raw inputs
$admin_user = $_POST['username'] ?? '';
$admin_pass = $_POST['password'] ?? '';

// Debug: Print received credentials
echo "Trying to login with: <br>";
echo "Username: $admin_user <br>";
echo "Password: $admin_pass <br>";

$stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $admin_user, $admin_pass);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    echo "Login successful!";
    $admin = $result->fetch_assoc();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_user'] = $admin['username'];
    header("Location: admin_dashboard.php");
} else {
    echo "FAILED. Database records: <pre>";
    $debug = $conn->query("SELECT * FROM admins");
    while($row = $debug->fetch_assoc()) print_r($row);
    echo "</pre>";
}

$stmt->close();
$conn->close();
?>