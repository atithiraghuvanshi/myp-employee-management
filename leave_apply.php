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
    <meta charset="UTF-8">
    <title>Apply for Leave</title>
    <link rel="stylesheet" href="design.css"> <!-- Your main design file -->
    <style>
        body {
            background-image: url('gate.avif');
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.7);
            margin: 50px auto;
            padding: 30px;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #fff;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #fff;
        }

        input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            margin-top: 5px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        button {
            margin-top: 25px;
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .mode-toggle, .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 12px;
            background: #444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .dark-mode {
            background-color: #1e1e1e;
            color: #eee;
        }

        .dark-mode .form-container {
            background-color: rgba(30, 30, 30, 0.85);
        }

        .dark-mode label, 
        .dark-mode h2 {
            color: #eee;
        }

        .dark-mode input, 
        .dark-mode select, 
        .dark-mode textarea {
            background-color: #333;
            color: white;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 120px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>📝 Apply for Leave</h2>
        <form action="leave_submit.php" method="POST">
            <label for="leave_type">Leave Type:</label>
            <select name="leave_type" id="leave_type" required>
                <option value="">-- Select --</option>
                <option value="Casual">Casual Leave</option>
                <option value="Sick">Sick Leave</option>
                <option value="Paid">Paid Leave</option>
            </select>

            <label for="from_date">From Date:</label>
            <input type="date" name="from_date" id="from_date" required>

            <label for="to_date">To Date:</label>
            <input type="date" name="to_date" id="to_date" required>

            <label for="reason">Reason:</label>
            <textarea name="reason" id="reason" rows="3" required placeholder="Reason for leave..."></textarea>

            <button type="submit">Apply Leave</button>
        </form>
        <div style="text-align:center;">
            <a href="dashboard.php"><button class="back-btn">⬅ Back to Dashboard</button></a>
            <button class="mode-toggle" onclick="toggleMode()">🌓 Toggle Mode</button>
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
