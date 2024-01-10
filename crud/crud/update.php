<?php
include('conn.php');

$conn = connection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json_data = json_decode($_POST['json_data'], true);
    $id =  $json_data['id'];
    $name = $json_data['name'];
    $email = $json_data['email'];
    $phone = $json_data['phone'];
    $currenttime = date('Y-m-d H:i:s');


    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;

    
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($image_tmp, $image_path)) {
            $result = $conn->query("UPDATE users SET name='$name', email='$email', phone='$phone', up_date='$currenttime', image='$image_name' WHERE id='$id'");

            if ($result) {
                echo "Updated user info successfully!";
            } else {
                echo "Error executing updating: " . $conn->error;
            }
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {

        $result = $conn->query("UPDATE users SET name='$name', email='$email', phone='$phone', up_date='$currenttime' WHERE id='$id'");

        if ($result) {
            echo "Updated user info successfully!";
        } else {
            echo "Error executing updating: " . $conn->error;
        }
    }
} else {
    echo "Method Error";
}

$conn->close();
?>
