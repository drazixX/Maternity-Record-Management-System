<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mrm');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the year from the request
$year = $_GET['year'];

// Prepare SQL statement to fetch the number of children per month
$sql = "
    SELECT 
        MONTHNAME(birth_date) AS month, 
        COUNT(*) AS count 
    FROM child 
    WHERE YEAR(birth_date) = ? 
    GROUP BY MONTH(birth_date)
    ORDER BY MONTH(birth_date)";
    
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $year);
$stmt->execute();
$result = $stmt->get_result();

$months = array();
$counts = array();

while ($row = $result->fetch_assoc()) {
    $months[] = $row['month'];
    $counts[] = $row['count'];
}

// Return the months and counts as JSON
echo json_encode(['months' => $months, 'counts' => $counts]);

$stmt->close();
$conn->close();
?>
