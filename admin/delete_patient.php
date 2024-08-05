<?php
include 'db_connection.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Move the data to archive_patient
        $move_sql = "INSERT INTO archive_patient 
                     (patient_id, first_name, middle_name, last_name, contact, birthdate, address, age, midwife_nurse_doctor, weight, size_of_tummy, bp, pr, rr, fh, fht, aog, created_at, updated_at, prenatal_schedule, expected_delivery, status, height, remarks)
                     SELECT patient_id, first_name, middle_name, last_name, contact, birthdate, address, age, midwife_nurse_doctor, weight, size_of_tummy, bp, pr, rr, fh, fht, aog, created_at, updated_at, prenatal_schedule, expected_delivery, status, height, remarks
                     FROM patient WHERE patient_id = ?";
        $stmt = $conn->prepare($move_sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();

        // Delete the data from patient
        $delete_sql = "DELETE FROM patient WHERE patient_id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect back to the patients list or display success message
        header('Location: patients.php');
    } catch (Exception $e) {
        // Rollback the transaction if something went wrong
        $conn->rollback();
        echo "Failed: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
