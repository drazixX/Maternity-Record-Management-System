<?php
header('Content-Type: application/json');

// Connect to your database
include('functions/db_connection.php');

$sql = "SELECT DISTINCT YEAR(expected_delivery) AS year FROM patient ORDER BY year DESC";
$result = mysqli_query($conn, $sql);

$years = [];
while ($row = mysqli_fetch_assoc($result)) {
    $years[] = $row['year'];
}

echo json_encode(['years' => $years]);
?>
