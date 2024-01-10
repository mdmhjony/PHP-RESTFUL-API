<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
function connection(){
    $conn = new mysqli("localhost", "root", "","package");
    if ($conn->connect_error)  die("Connection failed: " . $conn->connect_error);
    return $conn;
}

?>