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
        // Insert data into archive_patient
        $insert_query = "INSERT INTO archive_patient (patient_id, first_name, middle_name, last_name, contact, birthdate, address, age, midwife_nurse_doctor, weight, created_at, updated_at, prenatal_schedule, expected_delivery, status, height, remarks, patient_files, photo, husband_name, plan_to_deliver_at, lmp, civil_status, religion, educ_level, occupation, monthly_income, blood_type)
                         SELECT patient_id, first_name, middle_name, last_name, contact, birthdate, address, age, midwife_nurse_doctor, weight, created_at, updated_at, prenatal_schedule, expected_delivery, status, height, remarks, patient_files, photo, husband_name, plan_to_deliver_at, lmp, civil_status, religion, educ_level, occupation, monthly_income, blood_type
                         FROM patient WHERE patient_id = ?";
        $stmt_insert = $conn->prepare($insert_query);
        if (!$stmt_insert) {
            throw new Exception("Prepare statement failed for insert: " . $conn->error);
        }
        $stmt_insert->bind_param("i", $patient_id);
        if (!$stmt_insert->execute()) {
            throw new Exception("Execute statement failed for insert: " . $stmt_insert->error);
        }

        // Delete data from patient
        $delete_query = "DELETE FROM patient WHERE patient_id = ?";
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
        $stmt_insert->close();
        $stmt_delete->close();
        $conn->close();

        // Redirect with success message
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
