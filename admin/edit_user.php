<?php
// Include database connection
include('functions/db_connection.php'); // Ensure this path is correct

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare SQL query
    $query = "DELETE FROM user WHERE user_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>
                    alert('User deleted successfully.');
                    window.location.href = 'user.php'; // Update this with the page you want to redirect to
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
