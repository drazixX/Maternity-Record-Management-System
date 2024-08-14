<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mrm');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the immunization type ID from the request
$immunization_type_id = $_POST['immunization_type_id'];

// Prepare SQL statement
$sql = "DELETE FROM immun_type WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $immunization_type_id);

// Execute the query
if ($stmt->execute()) {
    echo "success"; // Indicate success
} else {
    echo "Error deleting immunization type: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
