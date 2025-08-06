<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "final");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['pass']) ? trim($_POST['pass']) : '';

if (empty($email) || empty($password)) {
    echo "<script>alert('Please enter both email and password.'); window.location.href = 'Form.php';</script>";
    $conn->close();
    exit();
}

// Query from emp_details for authentication
$stmt = $conn->prepare("SELECT * FROM emp_details WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // Compare password as plain text
    if (trim($user['Password']) === $password) {
        $_SESSION['user'] = $email;
        header("Location: Employee.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href = 'Form.php';</script>";
        exit();
    }
} else {
    // If not found, redirect to registration
    header("Location: Successful_Registration.php");
    exit();
}

$stmt->close();
$conn->close();
?>
