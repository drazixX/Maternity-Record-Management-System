<?php
include 'functions/db_connection.php'; // Ensure this path is correct

// SQL query to count prenatal_schedule per month
$query = "
    SELECT 
        MONTHNAME(prenatal_schedule) AS month,
        COUNT(*) AS count
    FROM patient
    WHERE prenatal_schedule IS NOT NULL
    GROUP BY MONTH(prenatal_schedule)
    ORDER BY MONTH(prenatal_schedule)
";

$result = mysqli_query($conn, $query);

$data = [];
$months = [];
$counts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $months[] = $row['month'];
    $counts[] = (int)$row['count'];
}

$response = [
    'months' => $months,
    'counts' => $counts
];

echo json_encode($response);
?>
