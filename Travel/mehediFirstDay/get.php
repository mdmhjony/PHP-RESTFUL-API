<?php
include('conn.php');
function handleGetRequest()
{
    $conn = connection();
    
    $result = $conn->query("SELECT * FROM agent ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);;
    echo json_encode($result);
    // $agents = array();
   
    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $agents[] = $row;
    //     }
    // }
    // echo json_encode($agents);
    
    // for ($i = sizeof($agents) - 1; $i >= 0; $i--) {
    //     echo json_encode($agents[$i]);
    // }
}
?>
