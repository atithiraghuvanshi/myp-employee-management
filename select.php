<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['user'])) {
    echo "<p style='color: red; text-align: center;'>Please log in to access full features.</p>";
}

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nameQuery = "SELECT id, name FROM emp_details";
$nameResult = $conn->query($nameQuery);

$employeeDetails = null;
$generatedQuery = '';
$viewOption = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'])) {
    $empId = $_POST['employee_id'];
    $viewOption = $_POST['view_option'] ?? '';

    $generatedQuery = "SELECT * FROM emp_details WHERE id = " . intval($empId);

    $stmt = $conn->prepare("SELECT * FROM emp_details WHERE id = ?");
    $stmt->bind_param("i", $empId);
    $stmt->execute();
    $employeeDetails = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Employee Details</title>
  <link rel="stylesheet" href="design.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('gate.avif');
        background-size: cover;
        background-attachment: fixed;
        color: #000;
        transition: background-color 0.3s, color 0.3s;
    }

    .dark-mode {
        background-color: #1e1e1e;
        color: #fff;
    }

    header {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 20px;
        text-align: center;
    }
    header h1 {
        margin: 0;
        color: #f0f0f0;
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
        color: #f0f0f0;
        font-weight: bold;
    }

    main {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.85);
        margin: 20px auto;
        width: 80%;
        border-radius: 10px;
        color: #000;
    }
    .dark-mode main {
        background-color: rgba(0, 0, 0, 0.75);
        color: #eee;
    }

    h2, h3 {
        color: #004080;
        text-align: center;
    }
    .dark-mode h2, .dark-mode h3 {
        color: #80cfff;
    }

    form {
        background: #fff;
        padding: 15px;
        margin: 20px auto;
        width: 90%;
        max-width: 700px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        color: #000;
    }
    .dark-mode form {
        background: #2c2c2c;
        color: #eee;
    }

    select, button {
        padding: 8px;
        font-size: 14px;
        margin-top: 10px;
    }

    button {
        background: #007BFF;
        color: white;
        border: none;
        cursor: pointer;
        margin-top: 10px;
    }
    button:hover {
        background: #0056b3;
    }

    .query-box {
        background-color: #eef5ff;
        border-left: 5px solid #007BFF;
        padding: 12px;
        margin: 20px auto;
        font-family: monospace;
        white-space: pre-wrap;
        width: 90%;
        max-width: 700px;
        color: #000;
    }
    .dark-mode .query-box {
        background-color: #333;
        color: #ccc;
    }

    table.detail-view {
        width: 90%;
        margin: 20px auto;
        background: #fff;
        color: #000;
    }
    .dark-mode table.detail-view {
        background: #2a2a2a;
        color: #fff;
    }

    table.detail-view th {
        width: 30%;
        background: #f2f2f2;
    }
    .dark-mode table.detail-view th {
        background: #444;
        color: #fff;
    }

    table.detail-view td, table.detail-view th {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .back-btn, .mode-toggle {
        display: inline-block;
        margin: 20px;
        padding: 10px 15px;
        background: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
    }

    .mode-toggle {
        background: #444;
    }
    .dark-mode .mode-toggle {
        background: #aaa;
        color: #000;
    }

    .logo {
        width: 150px;
        margin-bottom: 20px;
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
  <header>
    <h1>View Employee Details</h1>
    <nav>
      <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <img src="logo.png" alt="Logo" class="logo">
    <h2>🔍 View Individual Employee</h2>

    <form method="POST">
      <label>Select Employee:</label>
      <select name="employee_id" required>
        <option value="">-- Select --</option>
        <?php if ($nameResult && $nameResult->num_rows > 0): ?>
          <?php while ($row = $nameResult->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>" <?= (isset($employeeDetails) && $employeeDetails['id'] == $row['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($row['name']) ?>
            </option>
          <?php endwhile; ?>
        <?php endif; ?>
      </select>

      <label>View Option:</label>
      <select name="view_option" required>
        <option value="">-- Select --</option>
        <option value="all" <?= $viewOption === 'all' ? 'selected' : '' ?>>All Details</option>
        <option value="salary" <?= $viewOption === 'salary' ? 'selected' : '' ?>>Name & Salary</option>
        <option value="query" <?= $viewOption === 'query' ? 'selected' : '' ?>>SQL Query</option>
      </select>

      <button type="submit">Submit</button>
    </form>

    <?php if ($viewOption === 'query' && $generatedQuery): ?>
      <div class="query-box">
        <strong>Generated Query:</strong><br>
        <?= htmlspecialchars($generatedQuery) ?>
      </div>
    <?php endif; ?>

    <?php if ($employeeDetails): ?>
      <?php if ($viewOption === 'salary'): ?>
        <table class="detail-view">
          <tr><th>Name</th><td><?= htmlspecialchars($employeeDetails['name']) ?></td></tr>
          <tr><th>Salary</th><td><?= htmlspecialchars($employeeDetails['salary']) ?></td></tr>
        </table>
      <?php elseif ($viewOption === 'all'): ?>
        <table class="detail-view">
          <tr><th>Name</th><td><?= htmlspecialchars($employeeDetails['name']) ?></td></tr>
          <tr><th>Father's Name</th><td><?= htmlspecialchars($employeeDetails['fname']) ?></td></tr>
          <tr><th>Date of Birth</th><td><?= htmlspecialchars($employeeDetails['dob']) ?></td></tr>
          <tr><th>Email</th><td><?= htmlspecialchars($employeeDetails['email']) ?></td></tr>
          <tr><th>Phone</th><td><?= htmlspecialchars($employeeDetails['phone']) ?></td></tr>
          <tr><th>Gender</th><td><?= htmlspecialchars($employeeDetails['gender']) ?></td></tr>
          <tr><th>Department</th><td><?= htmlspecialchars($employeeDetails['dept']) ?></td></tr>
          <tr><th>Job Position</th><td><?= htmlspecialchars($employeeDetails['job_pos']) ?></td></tr>
          <tr><th>Experience</th><td><?= htmlspecialchars($employeeDetails['experience']) ?></td></tr>
          <tr><th>Salary</th><td><?= htmlspecialchars($employeeDetails['salary']) ?></td></tr>
          <tr><th>Company</th><td><?= htmlspecialchars($employeeDetails['company']) ?></td></tr>
        </table>
      <?php endif; ?>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; 2025 BLW Varanasi. All rights reserved.</p>
  </footer>

  <button class="mode-toggle" onclick="toggleMode()">🌓 Toggle Mode</button>

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

<?php if ($conn && $conn->ping()) $conn->close(); ?>
