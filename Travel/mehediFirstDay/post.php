<?php

function handlePostRequest($data)
{
    $conn = connection();
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $date = $data['date'];

    
    $sql = "INSERT INTO agent (name, email, phone, date) VALUES ('$name', '$email', '$phone', '$date')";

    if (mysqli_query($conn, $sql)) {
        $lastInsertId = mysqli_insert_id($conn); 
        http_response_code(201);
        echo json_encode(array("message" => "Agent created successfully", "id" => $lastInsertId));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Error: " . mysqli_error($conn)));
    }

    mysqli_close($conn);
}

?>
