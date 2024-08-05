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

$midwife_id = intval($_POST['midwife_id']);

// Begin transaction
$conn->begin_transaction();

try {
    // Move data from archive_midwife back to midwife
    $sql = "INSERT INTO midwife (first_name, middle_name, last_name, contact, email, address, birthdate, age, status, created_at)
            SELECT first_name, middle_name, last_name, contact, email, address, birthdate, age, status, created_at
            FROM archive_midwife
            WHERE midwife_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $midwife_id);
    $stmt->execute();

    // Delete the record from archive_midwife
    $sql = "DELETE FROM archive_midwife WHERE midwife_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $midwife_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    // Redirect to the midwives page with a success message
    header("Location: /MRM/admin/archive_midwives.php?message=restored");
    exit(); // Ensure no further code is executed after redirection
} catch (Exception $e) {
    // Rollback transaction if there was an error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn->close();
?>
