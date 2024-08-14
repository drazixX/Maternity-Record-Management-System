<?php
// delete_file.php
require_once 'functions/db_connection.php';

if (isset($_POST['file_name']) && isset($_POST['patient_id'])) {
    $fileName = $_POST['file_name'];
    $patientId = intval($_POST['patient_id']);
    
    // Query to get current file list
    $query = "SELECT patient_files FROM patient WHERE patient_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $files = explode(',', $row['patient_files']);
        $files = array_filter($files, function($file) use ($fileName) {
            return trim($file) !== $fileName;
        });
        
        $updatedFiles = implode(',', $files);
        $updateQuery = "UPDATE patient SET patient_files = ? WHERE patient_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("si", $updatedFiles, $patientId);
        if ($updateStmt->execute()) {
            // Optionally delete the actual file from the server
            // unlink('/path/to/files/' . $fileName);
            echo 'success';
        } else {
            echo 'error';
        }
        
        $updateStmt->close();
    } else {
        echo 'error';
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo 'error';
}
?>
