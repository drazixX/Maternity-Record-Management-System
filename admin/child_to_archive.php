<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mrm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the request
$id = intval($_POST['id']);

// Retry parameters
$maxRetries = 3;
$retryDelay = 100000; // 100 milliseconds
$attempt = 0;

while ($attempt < $maxRetries) {
    try {
        // Begin transaction
        $conn->begin_transaction();

        // Move the record to the archive table
        $stmt = $conn->prepare("INSERT INTO archive_child (mother_name, child_last_name, child_first_name, child_middle_name, gender, birth_date, weight, height) SELECT mother_name, child_last_name, child_first_name, child_middle_name, gender, birth_date, weight, height FROM child WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Delete the record from the child table
        $stmt = $conn->prepare("DELETE FROM child WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Commit transaction
        $conn->commit();

        echo json_encode(['success' => true]);
        exit; // Exit script after successful operation
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();

        // Check if it's a deadlock error
        if ($conn->errno == 1213) {
            $attempt++;
            usleep($retryDelay); // Sleep before retrying
        } else {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            exit; // Exit script after non-deadlock error
        }
    }
}

// If we exhausted retries, return an error
echo json_encode(['success' => false, 'error' => 'Failed to move record after multiple attempts.']);
$conn->close();
?>
