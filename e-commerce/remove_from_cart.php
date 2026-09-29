<?php
session_start();


if (isset($_GET['index'])) {
    $index_to_remove = $_GET['index'];
    
   
    if (isset($_SESSION['cart'][$index_to_remove])) {
        unset($_SESSION['cart'][$index_to_remove]);
        
       
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header("Location: cart.php");
exit();
?>