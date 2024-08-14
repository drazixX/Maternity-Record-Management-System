<?php
// Include database connection
include('functions/db_connection.php'); // Adjust the path if necessary

// Get the selected year from the request
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Prepare the SQL query to get the count of patients by status along with patient details for the selected year
$query = "SELECT status, COUNT(*) AS count, GROUP_CONCAT(patient_id) AS ids, 
                 GROUP_CONCAT(CONCAT_WS(' ', first_name, middle_name, last_name)) AS names
          FROM patient
          WHERE YEAR(expected_delivery) = ?
          GROUP BY status";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $year);
$stmt->execute();
$result = $stmt->get_result();

// Initialize arrays to hold the data
$statuses = [];
$counts = [];
$ids = [];
$names = [];

// Define the status mapping
$statusMapping = [
    'Pregnant' => 'Undergoing Prenatal Care',
    'Delivered_other' =>  'Delivered(Not in Clinic)',
];

// Fetch the data and store it in arrays
while ($row = $result->fetch_assoc()) {
    // Handle NULL values by converting them to 'No record'
    $status = $row['status'] ?? 'No record';
    
    // Map the status if it exists in the mapping array
    if (isset($statusMapping[$status])) {
        $status = $statusMapping[$status];
    }

    $statuses[] = $status;
    $counts[] = $row['count'];
    $ids[] = explode(',', $row['ids']);
    $names[] = explode(',', $row['names']);
}

// Close the database connection
$stmt->close();
$conn->close();

// Return the data as a JSON response
echo json_encode([
    'statuses' => $statuses,
    'counts' => $counts,
    'ids' => $ids,
    'names' => $names
]);
?>
