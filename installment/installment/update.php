<?php
include('conn.php');

$conn = connection();

$data = file_get_contents("php://input");

$dataArray = json_decode($data, true);

if ($dataArray !== null) {
    $id = $dataArray['id'];
    $amount = $dataArray['amount'];
    $title = $dataArray['title'];
    $des = $dataArray['description'];
    $date = date('Y-m-d H:i:s');
    $result = $conn->query("UPDATE installment SET amount='$amount', date='$date', title='$title', description='$des' WHERE id='$id'");

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Updated data executed successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error executing updating: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Error decoding JSON data."]);
}

$conn->close();
?>
