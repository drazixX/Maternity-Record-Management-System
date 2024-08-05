<?php
// Establish database connection
$mysqli = new mysqli('localhost', 'root', '', 'mrm'); // Update with your database credentials

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get patient ID from POST request
$patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : '';

// Prepare and execute query
$query = "SELECT * FROM patient WHERE patient_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
if ($result->num_rows > 0) {
    $response['status'] = 'success';
    $response['data'] = $result->fetch_assoc();
} else {
    $response['status'] = 'error';
    $response['message'] = 'No record found';
}

// Close the connection
$stmt->close();
$mysqli->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
