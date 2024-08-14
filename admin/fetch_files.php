<?php
// fetch_files.php
require_once 'functions/db_connection.php';

if (isset($_GET['patient_id'])) {
    $patientId = intval($_GET['patient_id']);
    
    // Query to get the files for the specified patient_id
    $query = "SELECT patient_files FROM patient WHERE patient_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $files = explode(',', $row['patient_files']); // Assuming files are stored as a comma-separated string
        $filesArray = [];
        
        foreach ($files as $file) {
            if (!empty($file)) {
                $file = trim($file);
                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                
                // Determine file type
                $fileType = '';
                switch (strtolower($fileExtension)) {
                    case 'pdf':
                        $fileType = 'PDF';
                        break;
                    case 'doc':
                    case 'docx':
                        $fileType = 'Word Document';
                        break;
                    case 'jpg':
                    case 'jpeg':
                        $fileType = 'Image';
                        break;
                    case 'png':
                        $fileType = 'Image';
                        break;
                    case 'mp4':
                        $fileType = 'Video';
                        break;
                    default:
                        $fileType = 'Unknown';
                        break;
                }
                
                $filesArray[] = [
                    'file_name' => $file,
                    'file_type' => $fileType
                ];
            }
        }
        
        echo json_encode($filesArray);
    } else {
        echo json_encode([]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode([]);
}
?>
