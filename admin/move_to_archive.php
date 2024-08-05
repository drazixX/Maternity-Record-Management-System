<?php
include 'C:\xampp\htdocs\MRM\admin\functions\db_connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['patient_id'])) {
    $patient_id = intval($_POST['patient_id']);
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert data into archive_patient
        $insert_query = "INSERT INTO archive_patient SELECT * FROM Patient WHERE patient_id = ?";
        $stmt_insert = $conn->prepare($insert_query);
        $stmt_insert->bind_param("i", $patient_id);
        $stmt_insert->execute();

        // Delete data from Patient
        $delete_query = "DELETE FROM Patient WHERE patient_id = ?";
        $stmt_delete = $conn->prepare($delete_query);
        $stmt_delete->bind_param("i", $patient_id);
        $stmt_delete->execute();

        // Commit transaction
        $conn->commit();

        $stmt_insert->close();
        $stmt_delete->close();
        $conn->close();

        echo "<script>
                alert('Patient successfully archived!');
                window.location.href = 'patient.php';
              </script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaction if something goes wrong
        $conn->rollback();
        $conn->close();
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = 'patient.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'patient.php';
          </script>";
    exit();
}
?>
