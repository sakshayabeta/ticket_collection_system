<?php
// Include required headers for CORS and allow DELETE method
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Retrieve staff ID from the request

$collection_id = $_REQUEST["collection_id"] ?? null;
//$email = $_REQUEST["email"] ?? null;

// Check if staff ID is provided
if (!$collection_id) {
    http_response_code(400); // Bad Request
    echo json_encode([
        "Status" => "false",
        "Message" => "Missing staff_id"
    ]);
    exit;
}




// Prepare SQL query
$qry = "DELETE FROM collection WHERE collection_id = '$collection_id'";
require_once("connectionclass.php");
$obj = new ConnectionClass();
$responds = $obj->Manipulation($qry);






// Check the result and return appropriate response
if ($responds) {
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
