<?php
include 'config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";

    if ($conn->query($sql)) {

        header("Location: admin_products.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>