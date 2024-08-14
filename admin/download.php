<?php
// download.php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']);
    $filePath = 'uploads/' . $file; // Set the path to the directory where files are stored

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        readfile($filePath);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'No file specified.';
}
?>
