<?php
include 'functions/db_connection.php';

// Fetch records from archive_immunizations table
$query = "SELECT * FROM archive_immunizations";
$result = $conn->query($query);

if ($result === false) {
    die("Error: " . $conn->error);
}
?>
