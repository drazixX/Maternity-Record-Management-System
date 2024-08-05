<?php
include 'functions/db_connection.php'; // Ensure correct path

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is set
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID is missing']);
    exit();
}

$id = intval($_POST['id']);

// Begin transaction
$conn->begin_transaction();

try {
    // Move data from archive_child back to child
    $sql = "INSERT INTO child (mother_name, child_last_name, child_first_name, child_middle_name, gender, birth_date, weight, height)
            SELECT mother_name, child_last_name, child_first_name, child_middle_name, gender, birth_date, weight, height
            FROM archive_child
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if the row was inserted
    if ($stmt->affected_rows === 0) {
        throw new Exception("No rows inserted into child");
    }

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
