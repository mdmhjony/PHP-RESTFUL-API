<?php
include('conn.php');
$conn = connection();

$conn = connection();
if(array_key_exists('id', $_GET))
{
    $id = $_GET['id'];
    $input = json_decode(file_get_contents('php://input'), true); 



   $result =$conn->query("DELETE FROM installment WHERE id ='$id'");

   if ($result) {
       echo json_encode(["status"=>"success",
                            "message"=>"Delete query executed successfully!"
                        ]
                        );
   } else {
    echo "Error executing delete query: " . $conn->error;
     }

 
   }


$conn->close();

?>