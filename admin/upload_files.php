<?php
// Establish database connection
$mysqli = new mysqli('localhost', 'root', '', 'mrm');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Initialize response array
$response = ['status' => 'error', 'message' => ''];

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && isset($_POST['patient_id'])) {
    $patientId = $mysqli->real_escape_string($_POST['patient_id']);
    $file = $_FILES['file'];

    // Define allowed file types and max file size
    $allowedTypes = [
        'application/pdf', 
        'image/jpeg', 
        'image/png', 
        'image/gif', 
        'text/plain', 
        'application/msword', 
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] = "Invalid file type.";
        } else if ($fileSize > $maxFileSize) {
            $response['message'] = "File size exceeds the maximum limit of 5MB.";
        } else {
            // Define upload directory
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpName, $filePath)) {
                $query = "SELECT patient_files FROM patient WHERE patient_id = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('s', $patientId);
                $stmt->execute();
                $stmt->bind_result($existingFiles);
                $stmt->fetch();
                $stmt->close();

                $newFiles = !empty($existingFiles) ? $existingFiles . ',' . $fileName : $fileName;

                $updateQuery = "UPDATE patient SET patient_files = ? WHERE patient_id = ?";
                $updateStmt = $mysqli->prepare($updateQuery);
                $updateStmt->bind_param('ss', $newFiles, $patientId);
                $updateStmt->execute();
                $updateStmt->close();

                $response['status'] = 'success';
                $response['message'] = "File uploaded successfully.";
            } else {
                $response['message'] = "Failed to move uploaded file.";
            }
        }
    } else {
        $response['message'] = "File upload error: " . $file['error'];
    }
} else {
    $response['message'] = "No file uploaded or patient ID missing.";
}

$mysqli->close();

// Output JavaScript to display the alert and redirect
if ($response['status'] === 'success') {
    echo "<script>
            alert('{$response['message']}');
            window.location.href = 'patient.php';
          </script>";
} else {
    echo "<script>
            alert('{$response['message']}');
            window.history.back();
          </script>";
}
?>
