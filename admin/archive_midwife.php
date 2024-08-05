
<?php
include 'functions/db_connection.php'; // Ensure correct path

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if midwife_id is set
if (!isset($_POST['midwife_id'])) {
    die("Midwife ID is missing");
}

$midwife_id = intval($_POST['midwife_id']); // Sanitize input

// Begin transaction
$conn->begin_transaction();

try {
    // Move data to archive_midwife (excluding patient_code)
    $sql = "INSERT INTO archive_midwife (first_name, middle_name, last_name, contact, email, address, birthdate, age, status, created_at)
            SELECT first_name, middle_name, last_name, contact, email, address, birthdate, age, status, created_at
            FROM midwife
            WHERE midwife_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $midwife_id);
    $stmt->execute();

    // Check if the row was inserted
    if ($stmt->affected_rows === 0) {
        throw new Exception("No rows inserted into archive_midwife");
    }

    // Delete the midwife record
    $sql = "DELETE FROM midwife WHERE midwife_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $midwife_id);
    $stmt->execute();

    // Check if the row was deleted
    if ($stmt->affected_rows === 0) {
        throw new Exception("No rows deleted from midwife");
    }

    // Commit transaction
    $conn->commit();

    // Redirect with a success message
    header("Location: /MRM/admin/midwives.php?message=archived_successfully");
    exit(); // Ensure no further code is executed after redirection
} catch (Exception $e) {
    // Rollback transaction if there was an error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn->close();
?>
