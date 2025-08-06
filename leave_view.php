<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Form.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Approve or reject logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['leave_id'])) {
    $action = $_POST['action'];
    $leave_id = intval($_POST['leave_id']);

    $status = ($action === 'approve') ? 'Approved' : 'Rejected';

    $updateStmt = $conn->prepare("UPDATE leave_requests SET status = ? WHERE id = ?");
    $updateStmt->bind_param("si", $status, $leave_id);
    $updateStmt->execute();
    $updateStmt->close();
}

// Fetch leave requests
$result = $conn->query("SELECT * FROM leave_requests ORDER BY from_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave Requests | Admin</title>
    <link rel="stylesheet" href="design.css">
    <style>
        body {
            background-image: url('gate.avif');
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .container {
            background-color: rgba(0,0,0,0.7);
            padding: 30px;
            margin: 40px auto;
            max-width: 90%;
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            color: #000;
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        form {
            display: inline-block;
        }

        .action-btn {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .approve-btn {
            background-color: #28a745;
            color: white;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
        }

        .mode-toggle, .back-btn {
            margin: 15px;
            padding: 8px 12px;
            background: #444;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .dark-mode table {
            background: #222;
            color: #eee;
        }

        .dark-mode th {
            background: #333;
        }

        .logo {
            width: 120px;
            display: block;
            margin: 0 auto 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" class="logo" alt="Logo">
        <h2>📋 Leave Requests</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= $row['leave_type'] ?></td>
                            <td><?= $row['from_date'] ?></td>
                            <td><?= $row['to_date'] ?></td>
                            <td><?= htmlspecialchars($row['reason']) ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <?php if ($row['status'] === 'Pending'): ?>
                                    <form method="POST">
                                        <input type="hidden" name="leave_id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="action" value="approve" class="action-btn approve-btn">Approve</button>
                                        <button type="submit" name="action" value="reject" class="action-btn reject-btn">Reject</button>
                                    </form>
                                <?php else: ?>
                                    <?= $row['status'] ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="8">No leave requests found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

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

<?php $conn->close(); ?>
