<?php
include 'functions/db_connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = intval($_POST['patient_id']);
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete data from archive_patient
        $delete_query = "DELETE FROM archive_patient WHERE patient_id = ?";
        $stmt_delete = $conn->prepare($delete_query);
        if (!$stmt_delete) {
            throw new Exception("Prepare statement failed for delete: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $patient_id);
        if (!$stmt_delete->execute()) {
            throw new Exception("Execute statement failed for delete: " . $stmt_delete->error);
        }

        // Commit transaction
        $conn->commit();

        // Close statements and connection
        $stmt_delete->close();
        $conn->close();

        // Redirect with success message
        echo "<script>
                alert('Patient permanently deleted!');
                window.location.href = 'archive_patient.php';
              </script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        $conn->close();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = 'archive_patient.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'archive_patient.php';
          </script>";
    exit();
}
?>
