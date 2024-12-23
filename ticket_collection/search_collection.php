<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Respond with 200 OK for preflight requests
    header("HTTP/1.1 200 OK");
    exit;
}

$name = $_POST["staff"];  // Staff name (or ID, depending on your frontend)
$start_date = $_POST["start_date"];  // Start date
$end_date = $_POST["end_date"];  // End date

require_once("connectionclass.php");
$obj = new ConnectionClass();

// Get the staff_id
$qry1 = "SELECT staff_id FROM staff WHERE name = '$name'";  // Assuming 'name' is the column in the 'staff' table
$staff_id = $obj->GetSingleData($qry1);

if (!$staff_id) {
    echo json_encode(['Status' => false, 'Message' => 'Invalid staff name']);
    exit;
}

// Query to fetch collection data
$query = "SELECT staff_id, date, amount, remarks
          FROM collection
          WHERE staff_id = '$staff_id' 
            AND date BETWEEN '$start_date' AND '$end_date'";

// Execute the query
$results = $obj->GetTable($query);

// Check results and return JSON response
if (!empty($results)) {
    echo json_encode(['Status' => true, 'Data' => $results]);
} else {
    echo json_encode(['Status' => false, 'Message' => 'No data found for the given criteria']);
}
?>
