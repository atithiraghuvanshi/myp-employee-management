<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = [];
$query = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $searchTerm = trim($_POST["search"] ?? "");

    if (!empty($searchTerm)) {
        $stmt = $conn->prepare("SELECT * FROM emp_details WHERE name LIKE ? OR dept LIKE ? OR job_pos LIKE ?");
        $likeTerm = "%$searchTerm%";
        $stmt->bind_param("sss", $likeTerm, $likeTerm, $likeTerm);
        $stmt->execute();
        $results = $stmt->get_result();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Employee</title>
    <link rel="stylesheet" href="design.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('gate.avif');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            color: #fff;
        }

        header {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            color: #fff;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        main {
            background-color: rgba(0, 0, 0, 0.6);
            margin: 30px auto;
            padding: 30px;
            width: 80%;
            border-radius: 10px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 60%;
            border-radius: 6px;
            border: none;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            margin-left: 10px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: rgba(255, 255, 255, 0.95);
            color: #000;
            border-radius: 6px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background: #eee;
        }

        .mode-toggle {
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 8px 12px;
            background: #444;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.75);
            color: #fff;
            margin-top: 40px;
        }

        /* Dark mode overrides */
        .dark-mode {
            color: #eee;
        }

        .dark-mode main {
            background-color: rgba(30, 30, 30, 0.85);
        }

        .dark-mode table {
            background: rgba(40, 40, 40, 0.95);
            color: #fff;
        }

        .dark-mode th {
            background: #333;
        }

        .dark-mode .mode-toggle {
            background: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>🔍 Search Employee</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="Employee.php">Register</a></li>
                <li><a href="select.php">View</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form method="POST">
            <input type="text" name="search" placeholder="Search by Name, Department or Position" required>
            <button type="submit">Search</button>
        </form>

        <?php if (!empty($results) && $results->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Job Position</th>
                    <th>Salary</th>
                    <th>Email</th>
                </tr>
                <?php while ($row = $results->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['dept']) ?></td>
                        <td><?= htmlspecialchars($row['job_pos']) ?></td>
                        <td><?= htmlspecialchars($row['salary']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <p style="text-align: center; color: yellow;">No employee found for your search.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 BLW Varanasi. All rights reserved.</p>
    </footer>

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

<?php
if ($conn) $conn->close();
?>
