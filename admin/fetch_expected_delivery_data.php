<?php
include 'functions/db_connection.php'; // Ensure this path is correct

// SQL query to count prenatal_schedule per month and get patient_ids
$query = "
    SELECT 
        MONTHNAME(expected_delivery) AS month,
        COUNT(*) AS count,
        GROUP_CONCAT(patient_id) AS patient_ids
    FROM patient
    WHERE expected_delivery IS NOT NULL
    GROUP BY MONTH(expected_delivery)
    ORDER BY MONTH(expected_delivery)
";

$result = mysqli_query($conn, $query);

$data = [];
$months = [];
$counts = [];
$patient_ids = [];

while ($row = mysqli_fetch_assoc($result)) {
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
?>
