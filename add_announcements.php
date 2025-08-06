<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Please log in first.'); window.location.href='Form.php';</script>";
    exit();
}

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $message = $_POST['message'] ?? '';

    $con = new mysqli('localhost', 'root', '', 'final');
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $stmt = $con->prepare("INSERT INTO announcements (title, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $message);

    if ($stmt->execute()) {
        $success = "✅ Announcement posted successfully at " . date('d M Y h:i A');
    } else {
        $error = "❌ Failed to post announcement.";
    }
    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Announcement</title>
  <link rel="stylesheet" href="main.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('gate.avif');
      background-size: cover;
      background-attachment: fixed;
      color: #fff;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .form-card {
      background-color: rgba(0, 0, 0, 0.75);
      padding: 30px;
      border-radius: 10px;
      width: 90%;
      max-width: 500px;
      text-align: center;
    }
    .form-card img.logo {
      width: 120px;
      margin-bottom: 20px;
    }
    .form-card h2 {
      color: #00ffcc;
    }
    form input[type="text"],
    form textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: none;
      font-size: 16px;
    }
    form textarea {
      resize: vertical;
    }
    button[type="submit"], .logout-btn, .mode-toggle {
      padding: 10px 20px;
      background-color: #00cc99;
      color: #fff;
      border: none;
      border-radius: 5px;
      margin-top: 10px;
      cursor: pointer;
      font-size: 16px;
      margin-right: 10px;
    }
    .logout-btn {
      background-color: #007bff;
      text-decoration: none;
      display: inline-block;
    }
    .mode-toggle {
      background-color: #444;
    }
    .dark-mode {
      background-color: #1e1e1e;
      color: #f0f0f0;
    }
    .dark-mode .form-card {
      background-color: rgba(255, 255, 255, 0.1);
    }
  </style>
</head>
<body>
<div class="container">
  <div class="form-card">
    <img src="logo.png" alt="Logo" class="logo">
    <h2>📢 Add New Announcement</h2>

    <?php if ($success): ?><p style="color: lightgreen;"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>

    <form method="POST">
      <input type="text" name="title" placeholder="Announcement Title" required>
      <textarea name="message" placeholder="Announcement Message" rows="5" required></textarea>
      <button type="submit">Post Announcement</button>
    </form>

    <a href="dashboard.php" class="logout-btn">🔙 Back to Dashboard</a>
    <button class="mode-toggle" onclick="toggleMode()">🌓</button>
  </div>
</div>

<script>
function toggleMode() {
  document.body.classList.toggle("dark-mode");
  localStorage.setItem("mode", document.body.classList.contains("dark-mode") ? "dark" : "light");
}
window.onload = () => {
  if (localStorage.getItem("mode") === "dark") {
    document.body.classList.add("dark-mode");
  }
};
</script>
</body>
</html>
