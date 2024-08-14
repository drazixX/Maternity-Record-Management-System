<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mrm');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct years from the birth_date column in the child table
$sql = "SELECT DISTINCT YEAR(birth_date) AS year FROM child ORDER BY year DESC";
$result = $conn->query($sql);

$years = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['year'];
    }
}

// Return the years as JSON
echo json_encode(['years' => $years]);

$conn->close();
?>
