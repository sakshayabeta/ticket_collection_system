<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}



// Retrieve username from the request body
$input = json_decode(file_get_contents("php://input"), true);
$username = $input['username'] ?? null;

// If session exists and username matches
if (isset($_SESSION['username']) && $_SESSION['username'] === $username) {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy session
    echo json_encode(["status" => "success", "message" => "Logged out successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "No active session found or invalid username."]);
}
?>
