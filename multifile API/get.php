<?php
function handleGetRequest()
{
    $conn = connection();
    
    $result = $conn->query("SELECT
    countries.id AS country_id,
    countries.name AS country_name,
    cities.id AS city_id,
    cities.name AS city_name,
    city_images.id AS image_id,
    city_images.image
    FROM
    countries
    JOIN
    cities ON countries.id = cities.country_id
    LEFT JOIN
    city_images ON cities.id = city_images.city_id")->fetch_all(MYSQLI_ASSOC);;
    
    echo json_encode($result);
}
?>
