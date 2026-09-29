<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    

    $image_name = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image_name);


    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {

        $sql = "INSERT INTO products (name, price, image, description) VALUES ('$name', '$price', '$image_name', '$description')";
        if ($conn->query($sql)) {
            header("Location: admin_products.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>