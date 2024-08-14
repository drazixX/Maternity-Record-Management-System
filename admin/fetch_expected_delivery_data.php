<?php
include 'functions/db_connection.php'; // Ensure this path is correct

$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y'); // Default to current year if no year is provided

// SQL query to count expected deliveries per month for the selected year and get patient_ids
$query = "
    SELECT 
        MONTHNAME(expected_delivery) AS month,
        COUNT(*) AS count,
        GROUP_CONCAT(patient_id) AS patient_ids
    FROM patient
    WHERE expected_delivery IS NOT NULL AND YEAR(expected_delivery) = ?
    GROUP BY MONTH(expected_delivery)
    ORDER BY MONTH(expected_delivery)
";

// Prepare the statement
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

// Bind the year parameter
$stmt->bind_param('i', $year);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

$months = [];
$counts = [];
$patient_ids = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $counts[] = (int)$row['count'];
    $patient_ids[] = explode(',', $row['patient_ids']); // Convert comma-separated string to array
}

$response = [
    'months' => $months,
    'counts' => $counts,
    'patient_ids' => $patient_ids
];

echo json_encode($response);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
