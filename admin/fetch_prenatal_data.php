<?php
include 'functions/db_connection.php';

$year = isset($_GET['year']) ? $_GET['year'] : '';

$sql = "SELECT DATE_FORMAT(prenatal_schedule, '%M') AS month, COUNT(*) AS count
        FROM patient
        WHERE YEAR(prenatal_schedule) = ?
        GROUP BY month
        ORDER BY MONTH(STR_TO_DATE(month, '%M'))";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $year);
$stmt->execute();
$result = $stmt->get_result();

$months = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $counts[] = $row['count'];
}

echo json_encode(['months' => $months, 'counts' => $counts]);

$stmt->close();
$conn->close();
?>
