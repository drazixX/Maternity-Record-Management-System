<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your password if applicable
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the patient ID from the form
$patient_id = $_POST['patient_id'];

// Update query to set prenatal_schedule to NULL
$sql = "UPDATE patient SET prenatal_schedule = NULL WHERE patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);

if ($stmt->execute()) {
    echo "Schedule cancelled successfully.";
} else {
    echo "Error cancelling schedule: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirect or provide a message to the user
header("Location: appointment.php"); // Replace with your page
exit;
?>
