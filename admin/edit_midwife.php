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

// Check if required POST data is received
if (!isset($_POST['midwife_id'], $_POST['first_name'], $_POST['last_name'])) {
    die("Required data is missing");
}

// Prepare and bind
$sql = "UPDATE midwife 
        SET first_name = ?, middle_name = ?, last_name = ?, contact = ?, email = ?, address = ?, birthdate = ?, age = ?, status = ?
        WHERE midwife_id = ?";
$stmt = $conn->prepare($sql);

// Check if prepare was successful
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters (Correct the type string to match the number of variables)
$stmt->bind_param("sssisssisi", 
    $_POST['first_name'], 
    $_POST['middle_name'], 
    $_POST['last_name'], 
    $_POST['contact'], 
    $_POST['email'], 
    $_POST['address'], 
    $_POST['birthdate'], 
    $_POST['age'],
    $_POST['status'],
    $_POST['midwife_id']
);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to midwives.php with success message
    header("Location: /MRM/admin/midwives.php?message=success");
    exit(); // Ensure no further code is executed after redirection
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
