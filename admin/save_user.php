<?php
// Include your database connection file
include('functions/db_connection.php'); // Ensure this path is correct

// Initialize a success flag
$success = false;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query
    $query = "INSERT INTO user (username, contact, password, user_type) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssss", $username, $contact, $hashedPassword, $userType);

        // Execute the statement
        if ($stmt->execute()) {
            $success = true; // Set success flag to true
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

// If successful, redirect with a success message
if ($success) {
    echo "<script>
            alert('New user added successfully.');
            window.location.href = 'user.php'; // Update this with the page you want to redirect to
          </script>";
}
?>
