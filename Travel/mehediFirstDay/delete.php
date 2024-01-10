<?php
function handleDeleteRequest($data)
{
    $conn = connection();

    $url_parts = explode('/', $_SERVER['REQUEST_URI']);
    $id_index = array_search('index.php', $url_parts);
    
    if ($id_index !== false && isset($url_parts[$id_index + 1])) {
        $id = $url_parts[$id_index + 1];
    } else {
        http_response_code(400); 
        echo json_encode(array("message" => "Error: 'id' is missing in the request"));
        return;
    }

    $stmt = $conn->prepare("DELETE FROM agent WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(array("message" => "Agent deleted successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Error: " . $stmt->error));
    }

    $stmt->close();
}

?>