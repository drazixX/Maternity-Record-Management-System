<?php
include 'functions/db_connection.php';

$response = array('success' => false);

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert record into immunizations
        $restoreQuery = "INSERT INTO immunizations (SELECT * FROM archive_immunizations WHERE id = ?)";
        $stmt = $conn->prepare($restoreQuery);
        if (!$stmt) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception('Execute statement failed: ' . $stmt->error);
        }

        // Delete record from archive_immunizations
        $deleteQuery = "DELETE FROM archive_immunizations WHERE id = ?";
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
