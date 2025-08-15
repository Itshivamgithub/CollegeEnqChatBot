<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth_demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "Signup successful! <a href='login.html'>Login now</a>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>