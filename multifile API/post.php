<?php

function handlePostRequest($data)
{
    $conn = connection();
    if (isset($data['country']) && isset($data['city'])) {
        $countryName = $data['country'];
        $cityName = $data['city'];

        $sql = "INSERT INTO countries (name) VALUES ('$countryName')";
        $conn->query($sql);
        $countryId = $conn->insert_id;

        $sql = "INSERT INTO cities (country_id, name) VALUES ('$countryId', '$cityName')";
        $conn->query($sql);
        $cityId = $conn->insert_id;
        $sql = "INSERT INTO city_images (city_id, image) VALUES ('$cityId', '" . $_FILES['file']['name'] . "')";
        $conn->query($sql);

        if (isset($_FILES['file'])) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        }

        echo json_encode(array("message" => "Data added successfully."));
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Invalid request data."));
    }

    mysqli_close($conn);
}

?>
