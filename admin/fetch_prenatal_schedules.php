<?php
header('Content-Type: application/json');

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

// Fetch data from the patient table
$sql = "SELECT patient_id, first_name, middle_name, last_name, prenatal_schedule FROM patient WHERE prenatal_schedule IS NOT NULL";
$result = $conn->query($sql);

$events = [];
while ($row = $result->fetch_assoc()) {
    $patient_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    $events[] = [
        'id' => $row['patient_id'],
        'title' => $patient_name,
        'start' => $row['prenatal_schedule'],
        // Add additional fields if necessary
    ];
}

echo json_encode($events);

$conn->close();
?>
