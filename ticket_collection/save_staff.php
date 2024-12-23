<?php

 // Save username in session
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
 header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token");
 if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
     // Respond with 200 OK for preflight requests
     header("HTTP/1.1 200 OK");
     exit;
 }
$name=$_REQUEST["name"];
$address=$_REQUEST["address"];
$phn_no=$_REQUEST["phn_no"];
$email=$_REQUEST["email"];
$password=$_REQUEST["password"];
$type="staff";
require_once("connectionclass.php");
$obj=new ConnectionClass();
$obj2=new ConnectionClass();
$sql= "INSERT INTO staff(name,address,phn_no,email,password)VALUES('$name','$address','$phn_no','$email','$password')";
$responds=$obj->Manipulation($sql);
$sql2= "INSERT INTO login (username, password, usertype) VALUES ('$email','$password','$type')";
$responds1=$obj2->Manipulation($sql2);
echo json_encode($responds);
?>