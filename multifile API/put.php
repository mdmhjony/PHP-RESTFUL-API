<?php

function handlePutRequest($data)
{
    $conn = connection();
    

    $sql = $conn->prepare("UPDATE citys SET img=?,  WHERE id=?");
    $sql->bind_param();

    if ($sql->execute()) {
        http_response_code(200); 
        echo json_encode(array("message" => "Agent updated successfully"));
    } else {
        http_response_code(500); 
        echo json_encode(array("message" => "Error: " . $sql->error));
    }

    $sql->close();
}


?>