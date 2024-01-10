<?php

function handlePutRequest($data)
{
    $conn = connection();
    $id = $data['id'];
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $date = $data['date'];

    $stmt = $conn->prepare("UPDATE agent SET name=?, email=?, phone=?, date=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $date, $id);

    if ($stmt->execute()) {
        http_response_code(200); 
        echo json_encode(array("message" => "Agent updated successfully"));
    } else {
        http_response_code(500); 
        echo json_encode(array("message" => "Error: " . $stmt->error));
    }

    $stmt->close();
}


?>