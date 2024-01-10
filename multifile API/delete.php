<?php
function handleDeleteRequest($data)
{
    $conn = connection();

    $part = explode('/', $_SERVER['REQUEST_URI']);
    $index = array_search('index.php', $part);
    
    if ($index !== false && isset($part[$index + 1])) {
        $id = $part[$index + 1];
    } else {
        http_response_code(400); 
        echo json_encode(array("message" => "Error: 'id' is missing in the request"));
        return;
    }

       $sql = $conn->prepare("DELETE FROM country WHERE id=?");
       $sql->bind_param("i", $id);

    if ($sql->execute()) {
        http_response_code(200);
        echo json_encode(array("message" => "country deleted successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Error: " . $sql->error));
    }

    $sql->close();
}

?>