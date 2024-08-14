<?php
// fetch_available_years.php
include 'functions/db_connection.php'; // Ensure this path is correct

$query = "SELECT DISTINCT YEAR(date_of_immunization) AS year FROM immunizations ORDER BY year DESC";
$result = mysqli_query($conn, $query);

$years = [];
while ($row = mysqli_fetch_assoc($result)) {
    $years[] = $row['year'];
}

$response = ['years' => $years];
echo json_encode($response);
?>
