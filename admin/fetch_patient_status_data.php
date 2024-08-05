<?php
// Include database connection
include('functions/db_connection.php'); // Adjust the path if necessary

// Prepare the SQL query to get the count of patients by status along with patient details
$query = "SELECT status, COUNT(*) AS count, GROUP_CONCAT(patient_id) AS ids, 
                 GROUP_CONCAT(CONCAT_WS(' ', first_name, middle_name, last_name)) AS names
          FROM patient
          GROUP BY status";
$result = $conn->query($query);

// Initialize arrays to hold the data
$statuses = [];
$counts = [];
$ids = [];
$names = [];

// Fetch the data and store it in arrays
while ($row = $result->fetch_assoc()) {
    // Handle NULL values by converting them to 'No record'
    $status = $row['status'] ?? 'No record';
    if ($status === null) {
        $status = 'No record';
    }

    $statuses[] = $status;
    $counts[] = $row['count'];
    $ids[] = explode(',', $row['ids']);
    $names[] = explode(',', $row['names']);
}

// Close the database connection
$conn->close();

// Return the data as a JSON response
echo json_encode([
    'statuses' => $statuses,
    'counts' => $counts,
    'ids' => $ids,
    'names' => $names
]);
?>
