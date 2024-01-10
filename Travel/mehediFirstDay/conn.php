<?php

function connection(){
    $conn = new mysqli("localhost", "root", "","flyfar");
    if ($conn->connect_error)  die("Connection failed: " . $conn->connect_error);
    return $conn;
}


?>