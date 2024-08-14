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
    $expected_delivery = $_POST['expected_delivery'] ?? null;
    $status = $_POST['status'] ?? null;
    $height = $_POST['height'] ?? null;
    $remarks = $_POST['remarks'] ?? null;
    $husband_name = $_POST['husband_name'] ?? null;
    $plan_to_deliver_at = $_POST['plan_to_deliver_at'] ?? null;
    $lmp = $_POST['lmp'] ?? null;
    $civil_status = $_POST['civil_status'] ?? null;
    $religion = $_POST['religion'] ?? null;
    $educ_level = $_POST['educ_level'] ?? null;
    $occupation = $_POST['occupation'] ?? null;
    $monthly_income = $_POST['monthly_income'] ?? null;
    $blood_type = $_POST['blood_type'] ?? null;

    // Validate required fields
    if (!$patient_id || !$first_name || !$last_name || !$contact || !$birthdate || !$address || !$age || !$midwife_nurse_doctor || !$weight || !$expected_delivery || !$status || !$height ) {
        $_SESSION['message'] = 'Please fill in all required fields.';
        $_SESSION['message_type'] = 'error';
        header("Location: /MRM/admin/patient.php");
        exit();
    }

    // Prepare and bind
    $sql = "UPDATE patient 
            SET first_name = ?, middle_name = ?, last_name = ?, contact = ?, birthdate = ?, address = ?, age = ?, midwife_nurse_doctor = ?, weight = ?, expected_delivery = ?, status = ?, height = ?, remarks = ?, lmp = ?,blood_type = ?, updated_at = NOW() 
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
            "ssssssssssssssss",
            $first_name, $middle_name, $last_name, $contact, $birthdate, $address, $age, $midwife_nurse_doctor, $weight, $expected_delivery, $status, $height, $remarks, $lmp, $blood_type, $patient_id
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
