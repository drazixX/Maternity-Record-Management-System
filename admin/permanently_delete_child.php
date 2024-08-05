<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mrm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the request
$id = intval($_POST['id']);

try {
    // Prepare and execute the SQL statement to permanently delete the record
    $stmt = $conn->prepare("DELETE FROM archive_child WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// Close connection
$conn->close();
?>
