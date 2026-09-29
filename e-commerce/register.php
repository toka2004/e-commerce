<?php
include 'config.php'; 

if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account - ElectroCity</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .reg-box { background: white; padding: 30px; border-radius: 10px; width: 350px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #1a237e; text-align: center; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn-reg { background: #1a237e; color: white; border: none; padding: 12px; width: 100%; cursor: pointer; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="reg-box">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register" class="btn-reg">Create Account</button>
        </form>
        <p style="text-align:center">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>