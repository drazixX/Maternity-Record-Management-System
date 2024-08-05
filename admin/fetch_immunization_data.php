<?php
// fetch_immunization_data.php
include 'functions/db_connection.php'; // Ensure this path is correct

// SQL query to count immunization_type
$query = "
    SELECT 
        immunization_type,
        COUNT(*) AS count
    FROM immunizations
    GROUP BY immunization_type
    ORDER BY immunization_type
";

$result = mysqli_query($conn, $query);

$data = [];
$types = [];
$counts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $types[] = $row['immunization_type'];
    $counts[] = (int)$row['count'];
}

$response = [
    'types' => $types,
    'counts' => $counts
];

echo json_encode($response);
?>
