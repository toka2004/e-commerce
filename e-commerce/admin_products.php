<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
include 'config.php';
?>
<?php
include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Manage Products</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding: 30px; }
        .admin-container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        h2 { color: #1a237e; }
        .btn-add { background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #1a237e; color: white; }
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; }
        .btn-delete { color: #d32f2f; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="header">
        <h2>Product Management</h2>
        <a href="add_product.php" class="btn-add">+ Add New Product</a>
        <a href="logout.php" style="color: #d32f2f; text-decoration: none; margin-left: 20px; font-weight: bold;">Logout</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $result = $conn->query("SELECT * FROM products");
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='images/" . $row['image'] . "' class='product-img'></td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>$" . $row['price'] . "</td>";
                echo "<td>" . substr($row['description'], 0, 50) . "...</td>";

                echo "<td><a href='delete_product.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>