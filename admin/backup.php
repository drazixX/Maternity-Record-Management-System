<?php
$host = 'localhost'; // your database host
$user = 'root'; // your database username
$pass = ''; // your database password
$db = 'mrm'; // your database name

// Define backup file path
$backup_file = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
$mysqldump_path = "C:\\xampp\\mysql\\bin\\mysqldump.exe"; // Update this path

// Command to create the backup
$command = "$mysqldump_path --opt -h $host -u $user -p$pass $db > $backup_file";

// Log the command for debugging
file_put_contents('command_log.txt', $command . PHP_EOL, FILE_APPEND);

// Execute the command and capture output
$output = [];
$return_var = null;
exec($command . ' 2>&1', $output, $return_var);

// Log output for debugging
file_put_contents('error_log.txt', implode("\n", $output), FILE_APPEND);

if ($return_var === 0 && file_exists($backup_file)) {
    // Display a success message and download the backup file
    echo "Backup created successfully.<br>";
    echo "Click <a href='backup.php?download=1'>here</a> to download the backup.";

    // Check if download parameter is set to handle file download
    if (isset($_GET['download']) && $_GET['download'] == '1') {
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
        readfile($backup_file);

        // Optionally, delete the backup file after download
        unlink($backup_file);
        exit;
    }
} else {
    // Output detailed error information
    echo "Error creating backup.<br>";
    echo "Return code: $return_var<br>";
    echo "Output: <pre>" . implode("\n", $output) . "</pre>";
}
?>
