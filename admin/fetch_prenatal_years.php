<?php
include 'functions/db_connection.php';

// Query to fetch distinct years from the prenatal_schedule column
$sql = "SELECT DISTINCT YEAR(prenatal_schedule) AS year FROM patient ORDER BY year DESC";

$result = $conn->query($sql);

$years = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['year'];
    }
}

echo json_encode(['years' => $years]);
?>
