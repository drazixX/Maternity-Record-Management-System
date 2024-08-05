<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your password if applicable
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $prenatal_schedule = $_POST['prenatal_schedule'];
    $remarks = $_POST['remarks'];

    // Split the patient name to first, middle, and last name
    $patient_name = $_POST['patient_name'];
    $name_parts = explode(' ', $patient_name);
    $first_name = $name_parts[0];
    $middle_name = isset($name_parts[1]) ? $name_parts[1] : '';
    $last_name = isset($name_parts[2]) ? $name_parts[2] : '';

    // Prepare an SQL statement to insert the new patient data
    $stmt = $conn->prepare("INSERT INTO patient (patient_id, first_name, middle_name, last_name, prenatal_schedule, remarks) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $patient_id, $first_name, $middle_name, $last_name, $prenatal_schedule, $remarks);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
