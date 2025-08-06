<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
$con = new mysqli('localhost', 'root', '', 'final');
if ($con->connect_error) {
    die("<h2 style='color:red'>❌ Connection failed: " . $con->connect_error . "</h2>");
}
$con->query("CREATE TABLE IF NOT EXISTS admin_logins (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), login_time DATETIME)");
$result = $con->query("SELECT * FROM admin_logins ORDER BY login_time DESC LIMIT 50");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login Logs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>🕒 Admin Login Logs</h2>
            <table style="width:100%;border-collapse:collapse;">
                <tr><th>Username</th><th>Login Time</th></tr>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['login_time']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            <a href="admin_dashboard.php">⬅️ Back to Dashboard</a>
        </div>
    </div>
    <script src="theme-toggle.js"></script>
</body>
</html>
<?php $con->close(); ?>
