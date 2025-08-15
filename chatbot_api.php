<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth_demo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$message = trim(strtolower($_POST['message']));

$stmt = $conn->prepare("SELECT response FROM chatbot_responses WHERE keyword LIKE ?");
$searchTerm = "%" . $message . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();

$result = $stmt->get_result();
$response = $result->num_rows > 0 
    ? $result->fetch_assoc()['response'] 
    : "I'm still learning. Please contact the college office for this query.";

echo json_encode(['response' => $response]);

$stmt->close();
$conn->close();
?>