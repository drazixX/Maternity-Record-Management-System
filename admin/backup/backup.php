<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mrm";

// Define backup file paths
$backupDir = 'C:\\xampp\\htdocs\\MRM\\admin\\backup\\';
$tempDir = 'C:\\xampp\\htdocs\\MRM\\admin\\backup\\temp\\';
$backupFileDB = $backupDir . 'backup_' . date('Y-m-d_H-i-s') . '.sql';
$backupFileSystem = $backupDir . 'system_files_' . date('Y-m-d_H-i-s') . '.zip';
$tempFileDB = $tempDir . basename($backupFileDB);
$tempFileSystem = $tempDir . basename($backupFileSystem);
$combinedBackupFile = $backupDir . 'full_backup_' . date('Y-m-d_H-i-s') . '.zip';
$errorFile = $backupDir . 'backup_error.log';

// Create temporary directory if it does not exist
if (!file_exists($tempDir)) {
    mkdir($tempDir, 0777, true);
}

// Full path to mysqldump executable
$mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

// Command to create database backup
$commandDB = "$mysqldumpPath --user=$username --password=$password --host=$servername $dbname > \"$backupFileDB\" 2> \"$errorFile\"";

// Execute the command for database backup
exec($commandDB, $outputDB, $returnVarDB);

// Create a zip file of the system directory
$zip = new ZipArchive();
if ($zip->open($backupFileSystem, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    die("Failed to create ZIP archive for system files.\n");
}

// Add files to the zip archive
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator('C:\\xampp\\htdocs\\MRM', RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $file) {
    if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen('C:\\xampp\\htdocs\\MRM') + 1);
        $zip->addFile($filePath, $relativePath);
    }
}

$zip->close();

// Move the backup files to the temporary directory
rename($backupFileDB, $tempFileDB);
rename($backupFileSystem, $tempFileSystem);

// Create a zip file containing both database and system backups
$combinedZip = new ZipArchive();
if ($combinedZip->open($combinedBackupFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    $combinedZip->addFile($tempFileDB, basename($tempFileDB));
    $combinedZip->addFile($tempFileSystem, basename($tempFileSystem));
    $combinedZip->close();

    // Send headers to force download the combined ZIP file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($combinedBackupFile) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($combinedBackupFile));
    readfile($combinedBackupFile);

    // Optionally delete backup files and temp directory after download
    unlink($tempFileDB);
    unlink($tempFileSystem);
    unlink($combinedBackupFile);
    rmdir($tempDir);

    exit;
} else {
    echo 'Failed to create the combined ZIP file.';
}

// Debugging output
echo "<pre>";
echo "Database Backup Command: $commandDB\n";
echo "Database Backup Output:\n";
print_r($outputDB);
echo "Database Backup Return Value: $returnVarDB\n";
echo "Database Backup File Exists: " . (file_exists($tempFileDB) ? 'Yes' : 'No') . "\n";
echo "System Backup File Exists: " . (file_exists($tempFileSystem) ? 'Yes' : 'No') . "\n";
echo "Combined Backup File Exists: " . (file_exists($combinedBackupFile) ? 'Yes' : 'No') . "\n";
echo "Error File Exists: " . (file_exists($errorFile) ? 'Yes' : 'No') . "\n";
echo "Error File Content:\n";
if (file_exists($errorFile)) {
    echo file_get_contents($errorFile);
}
echo "</pre>";
?>
