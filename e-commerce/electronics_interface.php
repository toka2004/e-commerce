<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroCity | Your Tech Destination</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #1a237e;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .nav {
            background-color: #303f9f;
            padding: 10px;
            text-align: center;
        }
        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        .hero {
            background-color: #e8eaf6;
            padding: 40px;
            text-align: center;
            border-bottom: 3px solid #1a237e;
        }
        .container {
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .product-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .product-image {
            width: 150px;
            height: 150px;
            background-color: #eee;
            float: left; /* Changed to left for English alignment */
            margin-right: 20px; /* Changed to margin-right */
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #777;
            border: 1px dashed #ccc;
        }
        .product-info {
            overflow: hidden;
        }
        .product-title {
            font-size: 18pt;
            color: #1a237e;
            margin: 0 0 10px 0;
        }
        .product-price {
            font-size: 15pt;
            color: #d32f2f;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .btn-buy {
            background-color: #2e7d32;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }
        .footer {
            background-color: #1a237e;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ElectroCity Store</h1>
        <p>Your Premier Destination for Latest Electronics</p>
        <div style="background: transparent; padding: 15px; text-align: center;">
    <form action="electronics_interface.php" method="GET">
        <input type="text" name="search" placeholder="What are you looking for?" 
               style="padding: 10px; width: 40%; border: 1px solid #ddd; border-radius: 20px; outline: none;">
        <button type="submit" style="padding: 10px 20px; background: #303f9f; color: white; border: 1px solid white; border-radius: 20px; cursor: pointer; margin-left: 10px;">
    Search
</button>
    </form>
</div>
    </div>
    
    <div class="nav">
        <a href="electronics_interface.php">Home</a>
        <a href="cart.php">Shopping Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
        <a href="#">Categories</a>
        <a href="#">My Account</a>
    </div>

    <div class="hero">
        <h2>2026 Mega Deals are Here!</h2>
        <p>Exclusive 20% discount on all Laptops for a limited time</p>
    </div>

    <div class="container">
        <h2 style="border-left: 5px solid #1a237e; padding-left: 15px;">Available Products</h2>
        
 <div class="product-grid">
 <?php

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
if ($search != '') {

    $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM products";
}

$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
?>
        <div class="product-card clearfix">
            <div class="product-image">
                <img src="images/<?php echo $row['image']; ?>" style="width: 100%;">
            </div>
            <div class="product-info">
                <h3 class="product-title"><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <div class="product-price">$<?php echo $row['price']; ?></div>
                
                <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn-buy">Add to Cart</a>
            </div>
        </div>
    <?php }  ?>
</div>

 
            </div>
        </div>
    </div>

    <div class="footer">
        <p> All Rights Reserved &copy; 2026</p>
    </div>
</body>
</html>