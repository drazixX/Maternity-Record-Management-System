<?php
// Database connection
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, contact FROM midwife";
$result = $conn->query($sql);

$midwives = [];
$contacts = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $midwives[] = $row['full_name'];
    $contacts[] = $row['contact'];
  }
}

$conn->close();

echo json_encode(['midwives' => $midwives, 'contacts' => $contacts]);
?>
