<?php
session_start();
$login_error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['pass'] ?? '';
    $con = new mysqli('localhost', 'root', '', 'final');
    if ($con->connect_error) {
        die("<h2 style='color:red'>❌ Connection failed: " . $con->connect_error . "</h2>");
    }
    $stmt = $con->prepare("SELECT pass FROM admin_details WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['pass']) {
            $_SESSION['admin'] = $username;
            // Log admin login
            $con->query("CREATE TABLE IF NOT EXISTS admin_logins (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), login_time DATETIME)");
            $stmtLog = $con->prepare("INSERT INTO admin_logins (username, login_time) VALUES (?, NOW())");
            $stmtLog->bind_param("s", $username);
            $stmtLog->execute();
            $stmtLog->close();
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $login_error = "Invalid username or password. Please try again.";
        }
    } else {
        $login_error = "Invalid username or password. Please try again.";
    }
    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Employee System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <img src="logo.png" alt="Logo" class="logo">
            <h2>🔑 Admin Login</h2>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="pass" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <?php if (!empty($login_error)): ?>
                <p style="color: red; text-align: center;"><?= $login_error ?></p>
            <?php endif; ?>
            <button class="mode-toggle" onclick="toggleMode()">🌓 Toggle Mode</button>
        </div>
    </div>
    <script src="theme-toggle.js"></script>
</body>
</html>
