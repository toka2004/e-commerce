<?php
session_start();
if (isset($_POST['login'])) {
    // Fixed credentials for testing
    if ($_POST['username'] == 'admin' && $_POST['password'] == '123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_products.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ElectroCity</title>
    <style>
        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: #1a237e; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-box { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            width: 350px; 
            text-align: center; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        h2 { color: #1a237e; margin-bottom: 25px; }
        input { 
            width: 100%; 
            padding: 12px; 
            margin: 10px 0; 
            border: 1px solid #ddd; 
            border-radius: 6px; 
            box-sizing: border-box; 
        }
        button { 
            background: #28a745; 
            color: white; 
            border: none; 
            padding: 12px; 
            width: 100%; 
            border-radius: 6px; 
            font-size: 16px; 
            font-weight: bold; 
            cursor: pointer; 
            transition: background 0.3s;
        }
        button:hover { background: #218838; }
        .error-msg { color: #d32f2f; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if(isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
    </div>
</body>
</html>