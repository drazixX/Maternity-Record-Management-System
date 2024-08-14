<?php
include 'functions/db_connection.php'; // Ensure this path is correct

// Get sort parameters from URL
$column = isset($_GET['column']) ? $_GET['column'] : 'patient_id';
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';

// Validate column name
$valid_columns = ['patient_id', 'patient_name', 'prenatal_schedule'];
if (!in_array($column, $valid_columns)) {
    $column = 'patient_id';
}

// Validate direction
$direction = ($direction === 'desc') ? 'desc' : 'asc';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch patient data with sorting
$query = "SELECT 
              patient_id,
              CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) AS patient_name,
              COALESCE(prenatal_schedule, 'No Schedule') AS prenatal_schedule
          FROM 
              patient
          ORDER BY 
              $column $direction";

// Execute query
$result = $conn->query($query);

// Fetch data and encode to JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

// Close connection
$conn->close();
?>
