<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mrm');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$immunization_type = $_POST['immunization_type'];

// Prepare SQL statement to insert the new immunization type
$sql = "INSERT INTO immun_type (immunization_type) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $immunization_type);

$response = [];
if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Immunization type added successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();

// Return response in JSON format
echo json_encode($response);
?>
