<?php
$con = new mysqli("localhost", "root", "", "final");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT * FROM announcements ORDER BY posted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📢 Announcements</title>
  <link rel="stylesheet" href="main.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('gate.avif');
      background-size: cover;
      background-attachment: fixed;
      margin: 0;
      color: #000;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      padding-top: 60px;
    }

    .announcement-container {
      background-color: rgba(0, 0, 0, 0.75);
      color: #fff;
      padding: 30px;
      border-radius: 12px;
      width: 90%;
      max-width: 800px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #00ffcc;
    }

    .announcement {
      margin-bottom: 25px;
      padding: 20px;
      border-left: 6px solid #00cc99;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
    }

    .announcement h2 {
      margin: 0 0 10px;
      color: #00ffcc;
    }

    .announcement p {
      margin: 5px 0;
    }

    .timestamp {
      font-size: 0.85em;
      color: #ccc;
    }

    .mode-toggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #444;
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 6px;
      cursor: pointer;
    }

    .dark-mode body,
    .dark-mode .announcement-container {
      background-color: #1e1e1e;
      color: #f0f0f0;
    }

    .dark-mode .announcement {
      background: rgba(255, 255, 255, 0.08);
    }

    .dark-mode .timestamp {
      color: #aaa;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="announcement-container">
      <h1>📢 Latest Announcements</h1>

      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="announcement">
            <h2><?= htmlspecialchars($row['title']) ?></h2>
            <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <p class="timestamp">🕒 <?= date("F j, Y, g:i A", strtotime($row['posted_at'])) ?></p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align: center;">No announcements found.</p>
      <?php endif; ?>

    </div>
  </div>

  <button class="mode-toggle" onclick="toggleMode()">🌓</button>

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
