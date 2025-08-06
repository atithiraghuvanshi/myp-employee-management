<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Form.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['user'];
    $leave_type = $_POST['leave_type'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $reason = $_POST['reason'];

    $conn = new mysqli("localhost", "root", "", "final");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO leave_requests (email, leave_type, from_date, to_date, reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $leave_type, $from_date, $to_date, $reason);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Leave request submitted successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ Error submitting leave request.'); window.location.href='leave_apply.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
