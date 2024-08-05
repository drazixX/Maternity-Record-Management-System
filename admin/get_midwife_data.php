<?php
include 'functions/db_connection.php'; // Ensure correct path

if (isset($_GET['id'])) {
    $midwife_id = $conn->real_escape_string($_GET['id']);
    
    $sql = "SELECT * FROM midwife WHERE midwife_id = '$midwife_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $midwife = $result->fetch_assoc();
        echo json_encode($midwife);
    } else {
        echo json_encode(array('error' => 'No data found.'));
    }
} else {
    echo json_encode(array('error' => 'ID not provided.'));
}

$conn->close();
?>
