<?php
include 'functions\db_connection.php';

$response = array('success' => false);

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert record into archive_immunizations
        $archiveQuery = "INSERT INTO archive_immunizations (SELECT * FROM immunizations WHERE id = ?)";
        $stmt = $conn->prepare($archiveQuery);
        if (!$stmt) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }

        // Delete record from immunizations
        $deleteQuery = "DELETE FROM immunizations WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        if (!$stmt) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }

        // Commit transaction
        mysqli_commit($conn);

        $response['success'] = true;
    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($conn);

        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
?>
