<?php
include 'functions/db_connection.php';

// Get the POST data
$id = $_POST['id'];
$childName = $_POST['child_name'];
$age = $_POST['age'];
$immunizationType = $_POST['immunization_type'];
$dateOfImmunization = $_POST['date_of_immunization'];
$remarks = $_POST['remarks'];

// Prepare the update query
$sql = "UPDATE immunizations SET child_name = ?, age = ?, immunization_type = ?, date_of_immunization = ?, remarks = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('sisssi', $childName, $age, $immunizationType, $dateOfImmunization, $remarks, $id);
if ($stmt->execute() === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$stmt->close();
$conn->close();

echo "Record updated successfully";
?>
