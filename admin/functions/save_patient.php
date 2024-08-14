<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your password if applicable
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the expected_delivery value is being received correctly
if (!isset($_POST['expected_delivery'])) {
    die("Expected delivery date is missing");
}

// Set default value for status if not provided
$status = isset($_POST['status']) ? $_POST['status'] : 'No Record from Clinic';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO patient (first_name, middle_name, last_name, contact, birthdate, address, height, age, midwife_nurse_doctor, weight, expected_delivery, status,  husband_name, 
        plan_to_deliver_at, lmp, civil_status, religion, educ_level, occupation, 
        monthly_income, blood_type, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?,?,?, NOW(), NOW())");

// Check if prepare was successful
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssssissssssssssssss", 
    $_POST['first_name'], 
    $_POST['middle_name'], 
    $_POST['last_name'], 
    $_POST['contact'], 
    $_POST['birthdate'], 
    $_POST['address'], 
    $_POST['height'],
    $_POST['age'], 
    $_POST['midwife_nurse_doctor'], 
    $_POST['weight'], 
    // $_POST['size_of_tummy'],
    $_POST['expected_delivery'],
    $status,
    $_POST['husband_name'],
    $_POST['plan_to_deliver_at'],
    $lmp,
    $_POST['civil_status'],
    $_POST['religion'],
    $_POST['educ_level'],
    $_POST['occupation'],
    $_POST['monthly_income'],
    $_POST['blood_type'],
    // $_POST['bp'], 
    // $_POST['pr'], 
    // $_POST['rr'], 
    // $_POST['fh'], 
    // $_POST['fht'], 
    // $_POST['aog']
);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to patient.php with success message
    header("Location: /MRM/admin/patient.php?message=success");
    exit(); // Ensure no further code is executed after redirection
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
