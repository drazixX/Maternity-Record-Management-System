<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mrm');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$id = $_POST['id'];
$mother_name = $_POST['mother_name'];
$child_last_name = $_POST['child_last_name'];
$child_first_name = $_POST['child_first_name'];
$child_middle_name = $_POST['child_middle_name'];
$gender = $_POST['gender'];
$birth_date = $_POST['birth_date'];
$weight = $_POST['weight'];
$height = $_POST['height'];

// Prepare SQL statement
$sql = "UPDATE child SET mother_name = ?, child_last_name = ?, child_first_name = ?, child_middle_name = ?, gender = ?, birth_date = ?, weight = ?, height = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssssi', $mother_name, $child_last_name, $child_first_name, $child_middle_name, $gender, $birth_date, $weight, $height, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
