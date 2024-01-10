<?php
include('conn.php');

$conn = connection();
if($_SERVER['REQUEST_METHOD']=='DELETE'){
    $input = json_decode(file_get_contents('php://input'), true); 


    $urlArray = explode('/', $_SERVER['REQUEST_URI']);

    $findId = array_search('delete.php', $urlArray);

    if ($findId !== false && isset($urlArray[$findId + 1])) {
        $id = $urlArray[$findId + 1];
    } else {
    http_response_code(400);
    echo json_encode(array("message" => "Error: 'id' is missing in the request"));
    return;
   }

   $result = $conn->query("DELETE FROM users WHERE id='$id'");

   if ($result) {
       echo "Delete query executed successfully!";
   } else {
    echo "Error executing delete query: " . $conn->error;
     }

 
   }
else{
    echo "Method Error";
}

$conn->close();

?>
