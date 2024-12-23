<?php
// Include required headers for CORS and allow PUT and OPTIONS methods
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Get the raw PUT data
$data = json_decode(file_get_contents("php://input"), true);

// Retrieve staff ID and other data from the request
$staff_id = $data["staff_id"] ?? null;
$name = $data["name"] ?? null;
$address = $data["address"] ?? null;
$phn_no = $data["phn_no"] ?? null;
$email = $data["email"] ?? null;
$password = $data["password"] ?? null;

// Check if staff ID and necessary fields are provided
if (!$staff_id || !$name || !$email || !$address || !$phn_no || !$password) {
    http_response_code(400); // Bad Request
    echo json_encode([
        "Status" => "false",
        "Message" => "Missing staff_id or required fields"
    ]);
    exit;
}

// Prepare SQL query to update staff record
$qry = "UPDATE staff SET name = '$name', email = '$email', address = '$address', phn_no = '$phn_no', password = '$password' WHERE staff_id = '$staff_id'";

// Include database connection
require_once("connectionclass.php");

$obj = new ConnectionClass();
$responds = $obj->Manipulation($qry);

// Check the result and return appropriate response
if ($responds) {
    echo json_encode([
        "Status" => "true",
        "Message" => "Staff record successfully updated"
    ]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode([
        "Status" => "false",
        "Message" => "Failed to update staff record"
    ]);
}
?>
