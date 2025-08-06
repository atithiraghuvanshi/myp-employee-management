<?php
session_start();

$login_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start(); // Prevent header errors

    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    $con = new mysqli('localhost', 'root', '', 'final');
    if ($con->connect_error) {
        die("<h2 style='color:red'>❌ Connection failed: " . $con->connect_error . "</h2>");
    }

    $stmt = $con->prepare("SELECT pass FROM login_details WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['pass']) {
            $_SESSION['user'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            $login_error = "Invalid email or password. Please try again.";
        }
    } else {
        $login_error = "Invalid email or password. Please try again.";
    }

    $stmt->close();
    $con->close();

    ob_end_flush();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Employee System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="background.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <img src="logo.png" alt="Logo" class="logo">
            <h2>🔐 Employee Login</h2>
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <?php if (!empty($login_error)): ?>
                <p style="color: red; text-align: center;"><?= $login_error ?></p>
            <?php endif; ?>
            <p style="text-align: center; margin-top: 20px;">
                Don't have an account? <a href="./Employee.php" style="color: blue; text-decoration: underline;">Register here</a>
            </p>
            <p style="text-align: center; margin-top: 10px;">
                <a href="admin_login.php" style="color: #d2691e; text-decoration: underline; font-weight: bold;">Admin Login</a>
            </p>
            <button class="mode-toggle" onclick="toggleMode()">🌓 Toggle Mode</button>
        </div>
    </div>

    <script src="theme-toggle.js"></script>
</body>
</html>
