<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Employee Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .dashboard-container {
        padding-top: 60px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .card {
        background: rgba(255, 255, 255, 0.6);
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
        font-weight: bold;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card a {
        text-decoration: none;
        color: #1e1e1e;
        font-size: 16px;
    }

    .dark-mode .card {
        background: rgba(0, 0, 0, 0.6);
    }

    .dark-mode .card a {
        color: #ffffff;
    }

    h1, h2 {
        text-align: center;
    }

    .logout-btn {
        text-align: center;
        margin-top: 30px;
    }

    .logo {
        width: 100px;
        position: absolute;
        top: 10px;
        left: 10px;
    }

    footer {
        text-align: center;
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: #f0f0f0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
  </style>
</head>
<body>
  <img src="logo.png" class="logo" alt="Logo">

  <button class="mode-toggle" onclick="toggleMode()"></button>

  <div class="container dashboard-container">
    <div class="form-card">
      <h1>👨‍💼 Welcome to BLW Employee Dashboard</h1>
      <p style="text-align:center;">Manage all employee-related operations from one place.</p>

      <div class="grid">
        <div class="card"><a href="leave_apply.php">📝 Apply Leave</a></div>
        <div class="card"><a href="leave_view.php">📥 View Leave Requests</a></div>
        <div class="card"><a href="view_announcements.php">📬 View Announcements</a></div>
        <div class="card"><a href="birthday_reminder.php">🎂 Birthday Reminders</a></div>
      </div>

      <div class="logout-btn">
        <a href="logout.php" class="logout-btn">🚪 Logout</a>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 BLW Varanasi. All rights reserved.</p>
  </footer>

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
