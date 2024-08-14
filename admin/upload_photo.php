<?php

require_once 'functions/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    $patient_id = $_POST['patient_id'];
    $photo = $_FILES['photo'];

    // Check if the file is a JPEG
    if ($photo['type'] == 'image/jpeg') {
        $target_dir = "admin/uploads/images/"; // Updated directory path

        // Retrieve current photo path from the database
        $sql = "SELECT photo FROM patient WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $stmt->bind_result($current_photo_path);
        $stmt->fetch();
        $stmt->close();

        // Delete the existing file if it exists
        if (!empty($current_photo_path) && file_exists($current_photo_path)) {
            unlink($current_photo_path);
        }

        // Set the new target file name with unique ID to avoid caching issues
        $target_file = $target_dir . uniqid() . '_' . basename($photo["name"]);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($photo["tmp_name"], $target_file)) {
            // Update the database with the new photo path
            $sql = "UPDATE patient SET photo = ? WHERE patient_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $patient_id);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'photo' => $target_file]);
            } else {
                echo json_encode(['status' => 'error', 'message' => "Error updating record: " . $conn->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => "Sorry, there was an error uploading your file."]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "Please upload a JPEG image."]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => "No file uploaded or invalid request."]);
}
?>
