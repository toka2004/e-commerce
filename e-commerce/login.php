<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    
    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            header("Location: electronics_interface.php");
            exit();
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ElectroCity</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 10px; width: 350px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #1a237e; text-align: center; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-login { background: #1a237e; color: white; border: none; padding: 12px; width: 100%; cursor: pointer; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <p style="text-align:center">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>