<?php
session_start(); 


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

  
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    array_push($_SESSION['cart'], $product_id);
}


header("Location: electronics_interface.php");
exit();
?>