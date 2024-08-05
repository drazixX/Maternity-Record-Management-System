<?php
include 'functions/db_connection.php';

// Retrieve form data
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$address = $_POST['address'];
$birthdate = $_POST['birthdate'];
$age = $_POST['age'];
$status = 'Active'; // Default status
$created_at = date('Y-m-d H:i:s');

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO midwife (first_name, middle_name, last_name, contact, email, address, birthdate, age, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $contact, $email, $address, $birthdate, $age, $status, $created_at);

if ($stmt->execute()) {
    // Redirect with a success message
    header("Location: midwives.php?message=added_successfully");
} else {
    // In case of an error, you might want to redirect with an error message
    header("Location: midwives.php?message=error&details=" . urlencode($stmt->error));
}
exit();
?>
