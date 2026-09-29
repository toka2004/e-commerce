<?php
session_start();
include 'config.php';


if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    die("<script>alert('Your cart is empty! Please add products from the home page first.'); window.location='electronics_interface.php';</script>");
}

if (isset($_POST['confirm_order'])) {
    $user_id = $_SESSION['user_id'];
    $address = $_POST['address'];
    $total_price = 0;
    $valid_items = [];


    foreach ($_SESSION['cart'] as $id => $qty) {
        $res = $conn->query("SELECT price FROM products WHERE id = " . intval($id));
        if ($row = $res->fetch_assoc()) {
            $total_price += ($row['price'] * $qty);
            $valid_items[] = ['id' => $id, 'price' => $row['price'], 'qty' => $qty];
        }
    }

    if (empty($valid_items)) {
        unset($_SESSION['cart']);
        die("<script>alert('Your shopping cart is empty. Please browse our products to start shopping.'); window.location='electronics_interface.php';</script>");
    }


    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, address) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $user_id, $total_price, $address);
    
    if ($stmt->execute()) {
        $order_id = $conn->insert_id;

        foreach ($valid_items as $item) {
            $conn->query("INSERT INTO order_items (order_id, product_id, price) VALUES ($order_id, {$item['id']}, {$item['price']})");
        }

        unset($_SESSION['cart']); 
        echo "<script>alert('CONGRATULATIONS! #$order_id'); window.location='electronics_interface.php';</script>";
    } else {
        echo "ERROR : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Order - ElectroCity</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; padding: 50px; text-align: center; }
        .box { background: white; padding: 30px; border-radius: 10px; display: inline-block; width: 400px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-top: 5px solid #1a237e; }
        textarea { width: 100%; height: 80px; margin: 15px 0; padding: 10px; border: 1px solid #ccc; border-radius: 5px; resize: none; }
        .btn { background: #28a745; color: white; border: none; padding: 15px 25px; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Confirm Your Order</h2>
        <form method="POST">
            <p>Shipping Address in Alexandria:</p>
            <textarea name="address" placeholder="Ex: 15 Street, Smouha, Alexandria" required></textarea>
            <button type="submit" name="confirm_order" class="btn">Confirm & Place Order</button>
        </form>
    </div>
</body>
</html>