<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your password if applicable
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $sql = "SELECT CONCAT(first_name, ' ', middle_name, ' ', last_name) AS patient_name FROM patient WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patient_id);
    $stmt->execute();
    $stmt->bind_result($patient_name);
    if ($stmt->fetch()) {
        echo htmlspecialchars($patient_name);
    } else {
        echo "";
    }
    $stmt->close();
}

$conn->close();
?>
