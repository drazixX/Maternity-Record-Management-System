<?php
// Include database connection file
include 'functions/db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch distinct years from the expected_delivery column
$sql = "SELECT DISTINCT YEAR(expected_delivery) as year FROM patient ORDER BY year DESC";
$result = $conn->query($sql);

$years = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $years[] = $row['year'];
    }
}

// Return the years as JSON
echo json_encode($years);

$conn->close();
?>
