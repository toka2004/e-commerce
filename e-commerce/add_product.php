<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
include 'config.php';
?>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 40px; }
        .form-container { max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #1a237e; text-align: center; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .btn-submit { background: #28a745; color: white; border: none; cursor: pointer; font-weight: bold; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #1a237e; text-decoration: none; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Product</h2>

    <form action="insert_product.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <textarea name="description" placeholder="Product Description" rows="4"></textarea>
        <label>Select Product Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="Add Product" class="btn-submit">
    </form>
    <a href="admin_products.php" class="btn-back">Back to Dashboard</a>
</div>

</body>
</html>