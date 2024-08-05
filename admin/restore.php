<?php
$host = 'localhost'; // your database host
$user = 'root'; // your database username
$pass = ''; // your database password
$db = 'mrm'; // your database name

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['backup_file'])) {
    $file = $_FILES['backup_file']['tmp_name'];

    if (is_uploaded_file($file)) {
        // Execute the SQL file to restore the database
        $command = "mysql -h $host -u $user -p$pass $db < $file";
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            echo "Database restored successfully.";
        } else {
            echo "Error restoring database.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restore Database</title>
    </head>
    <body>
        <h2>Restore Database</h2>
        <form action="restore.php" method="post" enctype="multipart/form-data">
            <label for="backup_file">Choose SQL file:</label>
            <input type="file" name="backup_file" id="backup_file" accept=".sql" required>
            <button type="submit">Upload and Restore</button>
        </form>
    </body>
    </html>
    <?php
}
?>
