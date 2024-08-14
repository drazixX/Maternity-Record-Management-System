<?php
// fetch_immunization_data.php
include 'functions/db_connection.php'; // Ensure this path is correct

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// SQL query to count immunizations per month for the selected year
$query = "
    SELECT 
        DATE_FORMAT(date_of_immunization, '%M') AS month,
        COUNT(*) AS count
    FROM immunizations
    WHERE YEAR(date_of_immunization) = ?
    GROUP BY month
    ORDER BY MONTH(date_of_immunization)
";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $year);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
$months = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $counts[] = (int)$row['count'];
}

$response = [
    'months' => $months,
    'counts' => $counts
];

echo json_encode($response);
?>
