

<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Respond with 200 OK for preflight requests
    header("HTTP/1.1 200 OK");
    exit;
}
$staff_id= $_REQUEST['staff_id'];
require_once("connectionclass.php");
$obj = new ConnectionClass();
$name = $_POST["name"];
$address = $_POST["address"];
$phn_no = $_POST["phn_no"];
$email = $_POST["email"];
$password = $_POST["password"];
     
  
    // Update query
$query = "UPDATE staff SET name = '$name', address = '$address', phn_no = '$phn_no', email= '$email', password='$password' WHERE staff_id = '$staff_id'";
$responds =$obj->Manipulation($query);
    
    


echo json_encode($responds);

?>





