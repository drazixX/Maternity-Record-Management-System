<?php
// Correct path to the database connection file
include('functions/db_connection.php'); // Adjust the path if necessary

// SQL queries to count records
$sql_patient = "SELECT COUNT(*) AS total FROM patient";
$sql_child = "SELECT COUNT(*) AS total FROM child";
$sql_immunizations = "SELECT COUNT(*) AS total FROM immunizations";

// Execute queries and fetch results
$result_patient = $conn->query($sql_patient);
$result_child = $conn->query($sql_child);
$result_immunizations = $conn->query($sql_immunizations);

$total_patients = $total_children = $total_immunizations = 0;

// Fetch data for each count
if ($result_patient->num_rows > 0) {
    $row_patient = $result_patient->fetch_assoc();
    $total_patients = $row_patient['total'];
}

if ($result_child->num_rows > 0) {
    $row_child = $result_child->fetch_assoc();
    $total_children = $row_child['total'];
}

if ($result_immunizations->num_rows > 0) {
    $row_immunizations = $result_immunizations->fetch_assoc();
    $total_immunizations = $row_immunizations['total'];
}

// Close the database connection
$conn->close();
?>
