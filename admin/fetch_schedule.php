<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch schedule data
$sql = "SELECT patient_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS patient_name, prenatal_schedule FROM patient";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if (!is_null($row["prenatal_schedule"])) {
            $events[] = [
                'title' => htmlspecialchars($row["patient_name"]),
                'start' => htmlspecialchars($row["prenatal_schedule"]),
                'url' => 'view_patient.php?id=' . htmlspecialchars($row["patient_id"]) // Optional URL for each event
            ];
        }
    }
} 

$conn->close();

// Return events as JSON
echo json_encode($events);
?>
