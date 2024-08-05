<?php
include 'functions/db_connection.php'; // Ensure correct path

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID is missing']);
    exit();
}

$id = intval($data['id']);

// Begin transaction
$conn->begin_transaction();

try {
    // Delete the record from archive_child
    $sql = "DELETE FROM archive_child WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if the row was deleted
    if ($stmt->affected_rows === 0) {
        throw new Exception("No rows deleted from archive_child");
    }

    // Commit transaction
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback transaction if there was an error
    $conn->rollback();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

// Close the connection
$conn->close();
?>
