<?php
session_start();

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$today = date('m-d');
$upcomingBirthdays = [];

// Fetch employees whose birthday is today or in next 7 days
$query = "SELECT name, dob, email FROM emp_details";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dob = date('m-d', strtotime($row['dob']));
        $now = strtotime(date('Y') . '-' . $dob);
        $diff = ($now - time()) / (60 * 60 * 24);

        if ($dob === $today || ($diff >= 0 && $diff <= 7)) {
            $upcomingBirthdays[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upcoming Birthdays</title>
    <link rel="stylesheet" href="design.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('gate.avif');
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }
        main {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            margin: 50px auto;
            width: 80%;
            border-radius: 10px;
        }
        h2 {
            color: #ffc107;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            background-color: rgba(255, 255, 255, 0.9);
            color: #000;
        }
        .dark-mode table th, .dark-mode table td {
            background-color: #2b2b2b;
            color: #fff;
        }
        .mode-toggle {
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 10px 15px;
            background: #444;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main>
        <h2>🎂 Upcoming Birthdays</h2>

        <?php if (count($upcomingBirthdays) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($upcomingBirthdays as $emp): ?>
                        <tr>
                            <td><?= htmlspecialchars($emp['name']) ?></td>
                            <td><?= date('d M', strtotime($emp['dob'])) ?></td>
                            <td><?= htmlspecialchars($emp['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align:center; font-size: 18px;">No upcoming birthdays in the next 7 days.</p>
        <?php endif; ?>
    </main>

    <button class="mode-toggle" onclick="toggleMode()">🌓</button>

    <script>
        function toggleMode() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("mode", document.body.classList.contains("dark-mode") ? "dark" : "light");
        }
        if (localStorage.getItem("mode") === "dark") {
            document.body.classList.add("dark-mode");
        }
    </script>
</body>
</html>
