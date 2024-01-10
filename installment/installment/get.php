<?php
include('conn.php');

$conn = connection();

if($_SERVER['REQUEST_METHOD']=='GET'){
 
$result = $conn->query("SELECT * FROM installment ORDER BY id")->fetch_all(MYSQLI_ASSOC);
echo json_encode($result);
}
else{
    echo "Method Error";
}
    
$conn->close();


?>
