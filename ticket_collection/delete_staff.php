<?php

// Include required headers for CORS and allow DELETE method
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Retrieve staff ID from the request
$staff_id = $_REQUEST["staff_id"] ?? null;
$email = $_REQUEST["email"] ?? null;

// Check if staff ID is provided
if (!$staff_id) {
    http_response_code(400); // Bad Request
    echo json_encode([
        "Status" => "false",
        "Message" => "Missing staff_id"
    ]);
    exit;
}


if (!$email) {
    http_response_code(400); // Bad Request
    echo json_encode([
        "Status" => "false",
        "Message" => "Missing email"
    ]);
    exit;
}

// Prepare SQL query
$qry = "DELETE FROM staff WHERE staff_id = '$staff_id'";
require_once("connectionclass.php");
$obj = new ConnectionClass();
$responds = $obj->Manipulation($qry);

$qry2= "DELETE FROM login WHERE username= '$email'";
$obj = new ConnectionClass();
$responds2= $obj->Manipulation($qry2);





// Check the result and return appropriate response
if (($responds) && ($responds2)) {
    echo json_encode([
        "Status" => "true",
        "Message" => "Staff record successfully deleted"
    ]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode([
        "Status" => "false",
        "Message" => "Failed to delete staff record"
    ]);
}
?>
