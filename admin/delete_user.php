<?php
// Include database connection
include('functions/db_connection.php'); // Ensure this path is correct

// Check if ID is provided
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare and execute the SQL DELETE query
    $query = "DELETE FROM user WHERE user_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            // Set success message and redirect URL
            $successMessage = "User deleted successfully!";
            $redirectUrl = "user.php";
            
            // Output JavaScript to show the message and redirect
            echo "<script>
                    alert('$successMessage');
                    window.location.href = '$redirectUrl';
                  </script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No user ID provided.";
}

// Close the connection
$conn->close();
?>
