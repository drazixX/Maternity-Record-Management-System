<?php
session_start(); // Start the session

include 'db_connection.php'; // Include database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data with default values
    $patient_id = $_POST['patient_id'] ?? null;
    $first_name = $_POST['first_name'] ?? null;
    $middle_name = $_POST['middle_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $contact = $_POST['contact'] ?? null;
    $birthdate = $_POST['birthdate'] ?? null;
    $address = $_POST['address'] ?? null;
    $age = $_POST['age'] ?? null;
    $midwife_nurse_doctor = $_POST['midwife_nurse_doctor'] ?? null;
    $weight = $_POST['weight'] ?? null;
    $size_of_tummy = $_POST['size_of_tummy'] ?? null;
    $bp = $_POST['bp'] ?? null;
    $pr = $_POST['pr'] ?? null;
    $rr = $_POST['rr'] ?? null;
    $fh = $_POST['fh'] ?? null;
    $fht = $_POST['fht'] ?? null;
    $aog = $_POST['aog'] ?? null;
    $expected_delivery = $_POST['expected_delivery'] ?? null;
    $status = $_POST['status'] ?? null;
    $height = $_POST['height'] ?? null;
    $remarks = $_POST['remarks'] ?? null;
    $prenatal_schedule = $_POST['prenatal_schedule'] ?? null;

    // Validate required fields
    if (!$patient_id || !$first_name || !$last_name || !$contact || !$birthdate || !$address || !$age || !$midwife_nurse_doctor || !$weight || !$size_of_tummy || !$bp || !$pr || !$rr || !$fh || !$fht || !$aog || !$expected_delivery || !$status || !$height) {
        $_SESSION['message'] = 'Please fill in all required fields.';
        $_SESSION['message_type'] = 'error';
        header("Location: /MRM/admin/patient.php");
        exit();
    }

    // Prepare and bind
    $sql = "UPDATE patient 
            SET first_name = ?, middle_name = ?, last_name = ?, contact = ?, birthdate = ?, address = ?, age = ?, midwife_nurse_doctor = ?, weight = ?, size_of_tummy = ?, bp = ?, pr = ?, rr = ?, fh = ?, fht = ?, aog = ?, expected_delivery = ?, status = ?, height = ?, remarks = ?, prenatal_schedule = ?, updated_at = NOW() 
            WHERE patient_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['message'] = 'Prepare failed: ' . htmlspecialchars($conn->error);
        $_SESSION['message_type'] = 'error';
        header("Location: /MRM/admin/patient.php");
        exit();
    } else {
        // Bind parameters
        $stmt->bind_param(
            "ssssssssssssssssssssss",
            $first_name, $middle_name, $last_name, $contact, $birthdate, $address, $age, $midwife_nurse_doctor, $weight, $size_of_tummy, $bp, $pr, $rr, $fh, $fht, $aog, $expected_delivery, $status, $height, $remarks, $prenatal_schedule, $patient_id
        );

        // Execute statement
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Record updated successfully';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error updating record: ' . htmlspecialchars($stmt->error);
            $_SESSION['message_type'] = 'error';
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();

    // Redirect to the patient page with a message
    header("Location: /MRM/admin/patient.php");
    exit();
} else {
    echo "Invalid request method";
}
?>
