<?php
include('conn.php');

$conn = connection();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json_data = json_decode($_POST['json_data'], true);
    $name = $json_data['name'];
    $email = $json_data['email'];
    $phone = $json_data['phone'];




    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;




        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }



        if (move_uploaded_file($image_tmp, $image_path)) {
            $emailQuery = $conn->query("SELECT * FROM users WHERE email = '$email'");

         if ($emailQuery->num_rows > 0) {
                echo "The email exists in the database.";
           } else {
                $result = $conn->query("INSERT INTO users (email, name, phone, image) VALUES ('$email', '$name', '$phone', '$image_name')");

              if ($result) {
                    echo json_encode(array("message" => "Data added successfully."));
              } else {

                    echo "Error executing create query: " . $conn->error;
                }
            }
        } else {
            echo "Failed to move the uploaded file.";
            
        }
    } else {
        echo "Image upload failed.";
    }
} else {

    echo "Method Error";
}

$conn->close();
?>
