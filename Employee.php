<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Allow access to the registration page without redirecting to Form.php
    echo "<p style='color: red; text-align: center;'>Please log in to access full features.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="background.css"> <!-- Updated stylesheet for background image -->
</head>
<body>
<div class="container">
    <div class="form-card">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>👤 Employee Full Details</h2>
        <form action="Successful_Registration.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="fname" placeholder="Father's Name" required>
            <input type="date" name="dob" required>
            <input type="email" name="email" placeholder="Email" required>
            <select name="gender" required>
                <option value="">Gender</option>
                <option>Male</option><option>Female</option><option>Other</option>
            </select>
            <input type="text" name="marital_status" placeholder="Marital Status">
            <textarea name="address" placeholder="Address" rows="3" required></textarea>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <input type="text" name="lang" placeholder="Languages Known">
            <input type="text" name="hobbies" placeholder="Hobbies">
            <input type="text" name="nationality" placeholder="Nationality">

            <h3>🎓 Education</h3>
            <input type="text" name="college" placeholder="College Name" required>
            <input type="text" name="cplace" placeholder="College Place">
            <input type="text" name="cdept" placeholder="Department">
            <input type="text" name="course" placeholder="Course">
            <input type="text" name="cgp" placeholder="CGPA / %" required>
            <input type="text" name="clang" placeholder="Programming Languages">

            <h3>💼 Job Details</h3>
            <input type="text" name="job_pos" placeholder="Job Position">
            <input type="text" name="dept" placeholder="Department">
            <input type="text" name="emp_id" placeholder="Employee ID" required>
            <input type="date" name="doj">
            <input type="number" name="salary" placeholder="Salary">
            <input type="text" name="experience" placeholder="Experience">
            <input type="text" name="company" placeholder="Company">

            <h3>📄 Additional Info</h3>
            <textarea name="work" placeholder="Describe your work here..." rows="4"></textarea>
            <textarea name="terms" placeholder="Terms and Conditions..." rows="3"></textarea>

            <button type="submit">Submit</button>
        </form>
        <a href="logout.php" class="logout-btn">🚪 Logout</a>
        <button class="mode-toggle" onclick="toggleMode()">🌓 Toggle Mode</button>
    </div>
</div>
<script src="theme-toggle.js"></script>
</body>
</html>
