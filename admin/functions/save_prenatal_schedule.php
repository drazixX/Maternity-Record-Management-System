<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your password if applicable
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $prenatal_schedule = $_POST['prenatal_schedule'];
    $remarks = $_POST['remarks'];

    $sql = "UPDATE patient SET prenatal_schedule = ?, remarks = ? WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $prenatal_schedule, $remarks, $patient_id);

    if ($stmt->execute()) {
        echo "Prenatal schedule saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
