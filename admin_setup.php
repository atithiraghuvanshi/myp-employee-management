<?php
// Run this ONCE to set up the admin user. Delete or secure this file after use.
$con = new mysqli('localhost', 'root', '', 'final');
if ($con->connect_error) {
    die("<h2 style='color:red'>❌ Connection failed: " . $con->connect_error . "</h2>");
}
$username = 'admin';
$password = 'admin123'; // Change this after first login
// Create table if not exists
$con->query("CREATE TABLE IF NOT EXISTS admin_details (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE, pass VARCHAR(255))");
// Insert admin user if not exists
$stmt = $con->prepare("SELECT * FROM admin_details WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $stmt2 = $con->prepare("INSERT INTO admin_details (username, pass) VALUES (?, ?)");
    $stmt2->bind_param("ss", $username, $password);
    $stmt2->execute();
    echo "<h2 style='color:green'>Admin user created. Username: admin, Password: admin123</h2>";
    $stmt2->close();
} else {
    echo "<h2 style='color:orange'>Admin user already exists.</h2>";
}
$stmt->close();
$con->close();
?>
