<?php
include 'functions\db_connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = intval($_POST['patient_id']);
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert data back into Patient
        $insert_query = "INSERT INTO Patient SELECT * FROM archive_patient WHERE patient_id = ?";
        $stmt_insert = $conn->prepare($insert_query);
        $stmt_insert->bind_param("i", $patient_id);
        $stmt_insert->execute();

        // Delete data from archive_patient
        $delete_query = "DELETE FROM archive_patient WHERE patient_id = ?";
        $stmt_delete = $conn->prepare($delete_query);
        $stmt_delete->bind_param("i", $patient_id);
        $stmt_delete->execute();

        // Commit transaction
        $conn->commit();

        $stmt_insert->close();
        $stmt_delete->close();
        $conn->close();

        echo "<script>
                alert('Patient successfully restored!');
                window.location.href = 'archive_patient.php'; // Adjust this to where you list archived patients
              </script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        $conn->close();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = 'archive_patient.php'; // Adjust this to where you list archived patients
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'archive_patient.php'; // Adjust this to where you list archived patients
          </script>";
    exit();
}
?>
