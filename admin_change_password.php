<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST['old_pass'] ?? '';
    $new = $_POST['new_pass'] ?? '';
    $con = new mysqli('localhost', 'root', '', 'final');
    $username = $_SESSION['admin'];
    $stmt = $con->prepare("SELECT pass FROM admin_details WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($old === $row['pass']) {
            $stmt2 = $con->prepare("UPDATE admin_details SET pass = ? WHERE username = ?");
            $stmt2->bind_param("ss", $new, $username);
            $stmt2->execute();
            $msg = "<span style='color:green'>Password changed successfully.</span>";
            $stmt2->close();
        } else {
            $msg = "<span style='color:red'>Old password incorrect.</span>";
        }
    }
    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Admin Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>🔑 Change Admin Password</h2>
            <form method="POST">
                <input type="password" name="old_pass" placeholder="Old Password" required>
                <input type="password" name="new_pass" placeholder="New Password" required>
                <button type="submit">Change Password</button>
            </form>
            <div style="text-align:center;"> <?= $msg ?> </div>
            <a href="admin_dashboard.php">⬅️ Back to Dashboard</a>
        </div>
    </div>
    <script src="theme-toggle.js"></script>
</body>
</html>
