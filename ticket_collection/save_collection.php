<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Respond with 200 OK for preflight requests
    header("HTTP/1.1 200 OK");
    exit;
}

// Retrieve data from the front-end
$date = $_POST["date"];
$amount = $_POST["amount"];
$remarks = $_POST["remarks"];
$username = $_POST["username"];  // Get username from the form data
require_once("connectionclass.php");
$obj = new ConnectionClass();
// Step 1: Retrieve the staff_id using the username (email)
//var_dump($date, $amount, $username, $remarks);
//echo $username;


$query = "SELECT staff_id FROM staff WHERE email = '$username'";
$staff_id = $obj->GetSingleData($query);

//$result = $stmt->get_result();




// Step 2: Check if the username exists and get the staff_id
//if ($result->num_rows > 0) {
    //$row = $result->fetch_assoc();
    //$staff_id = $row['staff_id'];

    // Step 3: Prepare the SQL query to insert into the collection table
$qry = "INSERT INTO collection (date, amount, staff_id, remarks) VALUES ('$date','$amount','$staff_id','$remarks')";
$responds = $obj->Manipulation($qry);
echo json_encode($responds);
    //$stmt->bind_param("ssss", $date, $amount, $staff_id, $remarks);  // Bind the form data parameters
   
    // Step 4: Execute the query
    


// Step 5: Return the response as JSON

?>
