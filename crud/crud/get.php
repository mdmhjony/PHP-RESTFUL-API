<?php
include('conn.php');

$conn = connection();

if($_SERVER['REQUEST_METHOD']=='GET'){
 
$result = $conn->query("SELECT * FROM users ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
echo json_encode($result);
}
else{
    echo "Method Error";
}
    
$conn->close();


?>
