<?php
// Include database connection
include('functions/db_connection.php'); // Adjust the path if necessary

// Get the query parameter
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Prepare the SQL query to get patient details based on status
$sql = "SELECT patient_id, CONCAT_WS(' ', first_name, middle_name, last_name) AS full_name
        FROM patient
        WHERE status = ?";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

// Bind parameters and execute
$stmt->bind_param("s", $status);
$stmt->execute();
$result = $stmt->get_result();

// Check for query errors
if (!$result) {
    die('Query Error: ' . htmlspecialchars($conn->error));
}

// Fetch data
$patients = [];
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

// Close the database connection
$conn->close();

// Return the data as a JSON response
echo json_encode($patients);
?>
