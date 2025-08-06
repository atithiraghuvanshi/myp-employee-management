<?php
session_start();
$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get statistics
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM emp_details");
$totalEmployees = $totalResult->fetch_assoc()['total'];

// Department count
$deptResult = $conn->query("SELECT dept, COUNT(*) as count FROM emp_details GROUP BY dept");
$deptData = [];
while ($row = $deptResult->fetch_assoc()) {
    $deptData[$row['dept']] = $row['count'];
}

// Gender count
$genderResult = $conn->query("SELECT gender, COUNT(*) as count FROM emp_details GROUP BY gender");
$genderData = [];
while ($row = $genderResult->fetch_assoc()) {
    $genderData[$row['gender']] = $row['count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Statistics</title>
    <link rel="stylesheet" href="design.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('gate.avif') no-repeat center center fixed;
            background-size: cover;
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
        main {
            margin: 30px auto;
            padding: 20px;
            width: 90%;
            max-width: 900px;
            background-color: rgba(0,0,0,0.6);
            border-radius: 12px;
        }
        canvas {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
        }
        .chart-container {
            margin: 30px auto;
        }
        .mode-toggle {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #444;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }
        .dark-mode {
            background-color: #181818;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    <header>
        <h1>📊 Employee Statistics Dashboard</h1>
    </header>

    <main>
        <h2>Total Employees: <?= $totalEmployees ?></h2>

        <div class="chart-container">
            <h3>Department-wise Count</h3>
            <canvas id="deptChart" width="400" height="200"></canvas>
        </div>

        <div class="chart-container">
            <h3>Gender Distribution</h3>
            <canvas id="genderChart" width="400" height="200"></canvas>
        </div>
    </main>

    <button class="mode-toggle" onclick="toggleMode()">🌓</button>

    <script>
    const deptCtx = document.getElementById('deptChart').getContext('2d');
    const genderCtx = document.getElementById('genderChart').getContext('2d');

    const deptChart = new Chart(deptCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($deptData)) ?>,
            datasets: [{
                label: 'Employees',
                data: <?= json_encode(array_values($deptData)) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const genderChart = new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_keys($genderData)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($genderData)) ?>,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        }
    });

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
<?php $conn->close(); ?>
