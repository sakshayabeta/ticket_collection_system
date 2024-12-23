<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

// Validate username
if (!isset($_GET["username"]) || empty($_GET["username"])) {
    echo json_encode(["Status" => false, "Message" => "Username is required"]);
    exit;
}


$username = $_GET["username"];
$date= $_REQUEST["date"];

require_once("connectionclass.php");
$obj = new ConnectionClass();

// Fetch staff_id for the given username
$qry1 = "SELECT staff_id FROM staff WHERE email = '$username'";
$staff_id = $obj->GetSingleData($qry1);

// If staff_id is not found, return an error
if (!$staff_id) {
    echo json_encode(["Status" => false, "Message" => "Invalid username"]);
    exit;
}

// Fetch collections associated with the staff_id
$qry = "SELECT * FROM collection WHERE staff_id = '$staff_id' and date = '$date'";
$responds = $obj->GetTable($qry);

// Return collection data as JSON
echo json_encode($responds);
?>
