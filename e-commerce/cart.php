<?php
session_start();
include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Shopping Cart</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f9; padding: 40px; }
        .cart-container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #1a237e; text-align: center; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #333; }
        .total-row { font-size: 20px; font-weight: bold; color: #d32f2f; text-align: right; }
        .btn-group { margin-top: 30px; display: flex; justify-content: space-between; }
        .btn { padding: 10px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .btn-back { background-color: #1a237e; color: white; }
        .btn-checkout { background-color: #28a745; color: white; }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>
    
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        $grand_total = 0;
        if (!empty($_SESSION['cart'])) {
            
            foreach ($_SESSION['cart'] as $index => $id) {
                $result = $conn->query("SELECT * FROM products WHERE id = $id");
                if ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>$" . number_format($row['price'], 2) . "</td>";
                   
                    echo "<td><a href='remove_from_cart.php?index=$index' style='color:red; text-decoration:none; font-weight:bold;'>Remove</a></td>";
                    echo "</tr>";
                    $grand_total += $row['price'];
                }
            }
        } else {
            echo "<tr><td colspan='3' style='text-align:center;'>Your cart is empty!</td></tr>";
        }
        ?>
    </tbody>
</table>
<div style="margin-top: 30px; text-align: right;">

    <a href="electronics_interface.php" style="text-decoration: none; color: #1a237e; margin-right: 20px;">
        ← Continue Shopping
    </a>


    <a href="checkout.php" class="btn" style="
        background-color: #28a745; 
        color: white; 
        padding: 15px 30px; 
        text-decoration: none; 
        border-radius: 5px; 
        font-weight: bold;
        display: inline-block;
    ">Proceed to Checkout</a>
</div>

    <div class="total-row">
        Total Amount: $<?php echo number_format($grand_total, 2); ?>
    </div>

    <div class="btn-group">
        <a href="electronics_interface.php" class="btn btn-back">Back to Store</a>
        <?php if ($grand_total > 0): ?>
            <a href="#" class="btn btn-checkout">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>