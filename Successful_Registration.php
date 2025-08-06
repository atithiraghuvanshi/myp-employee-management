<?php
// Collect form data from POST
$name = $_POST["name"] ?? "";
$fname = $_POST["fname"] ?? "";
$dob = $_POST["dob"] ?? "";
$email = $_POST["email"] ?? "";
$gender = $_POST["gender"] ?? "";
$maritalStatus = $_POST["marital_status"] ?? "";
$address = $_POST["address"] ?? "";
$phone = $_POST["phone"] ?? "";
$languages = $_POST["lang"] ?? "";
$hobbies = $_POST["hobbies"] ?? "";
$nationality = $_POST["nationality"] ?? "";

$college = $_POST["college"] ?? "";
$cplace = $_POST["cplace"] ?? "";
$cdept = $_POST["cdept"] ?? "";
$course = $_POST["course"] ?? "";
$percentage = $_POST["cgp"] ?? "";
$programmingLanguages = $_POST["clang"] ?? "";

$jobPosition = $_POST["job_pos"] ?? "";
$department = $_POST["dept"] ?? "";
$employeeID = $_POST["emp_id"] ?? "";
$doj = $_POST["doj"] ?? "";
$salary = $_POST["salary"] ?? "";
$experience = $_POST["experience"] ?? "";
$company = $_POST["company"] ?? "";
$work = $_POST["work"] ?? "";
$terms = $_POST["terms"] ?? "Not Accepted";
$password = $_POST["pass"] ?? "";

// Connect to DB
$con = new mysqli('localhost', 'root', '', 'final');
if ($con->connect_error) {
    die("<h2 style='color:red'>❌ Connection failed: " . $con->connect_error . "</h2>");
}

// Prepare the SQL (27 fields = 27 ?)
$stmt = $con->prepare("INSERT INTO emp_details (
    name, fname, dob, email, gender, marital_status, address, phone,
    lang, hobbies, nationality, college, cplace, cdept, course, cgp, clang,
    job_pos, dept, emp_id, doj, salary, experience, company, work, terms, Password
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind 27 values
$stmt->bind_param("sssssssssssssssssssssssssss",
    $name, $fname, $dob, $email, $gender, $maritalStatus, $address, $phone,
    $languages, $hobbies, $nationality, $college, $cplace, $cdept, $course, $percentage, $programmingLanguages,
    $jobPosition, $department, $employeeID, $doj, $salary, $experience, $company, $work, $terms, $password
);

// Execute and handle result
if ($stmt->execute()) {
    echo "<h2 style='color:green; font-family:Arial;'>🎉 Employee registered successfully in BLW Varanasi!</h2>";
} else {
    echo "<h2 style='color:red; font-family:Arial;'>❌ Error: " . htmlspecialchars($stmt->error) . "</h2>";
}

$stmt->close();
$con->close();
?>
