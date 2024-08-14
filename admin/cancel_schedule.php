<?php
include 'functions/db_connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_id'])) {
    $schedule_id = intval($_POST['schedule_id']);
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Update the prenatal_schedule to NULL
        $cancel_query = "UPDATE patient SET prenatal_schedule = NULL WHERE patient_id = ?";
        $stmt_cancel = $conn->prepare($cancel_query);
        if (!$stmt_cancel) {
            throw new Exception("Prepare statement failed for update: " . $conn->error);
        }
        $stmt_cancel->bind_param("i", $schedule_id);
        if (!$stmt_cancel->execute()) {
            throw new Exception("Execute statement failed for update: " . $stmt_cancel->error);
        }

        // Commit transaction
        $conn->commit();

        // Close statements and connection
        $stmt_cancel->close();
        $conn->close();

        // Redirect with success message
        echo "<script>
                alert('Schedule successfully canceled!');
                window.location.href = 'appointment.php';
              </script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        $conn->close();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = 'appointment.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'appointment.php';
          </script>";
    exit();
}
?>
