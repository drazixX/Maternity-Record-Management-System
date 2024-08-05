<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mrm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Print the POST data
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (isset($_POST['child_name'], $_POST['age'], $_POST['immunization_type'], $_POST['date_of_immunization'], $_POST['remarks'])) {
        $child_name = $_POST['child_name'];
        $age = $_POST['age'];
        $immunization_type = $_POST['immunization_type'];
        $date_of_immunization = $_POST['date_of_immunization'];
        $remarks = $_POST['remarks'];

        // Prepare and execute SQL statement
        $sql = "INSERT INTO immunizations (child_name, age, immunization_type, date_of_immunization, remarks) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param("sisss", $child_name, $age, $immunization_type, $date_of_immunization, $remarks);

        if ($stmt->execute()) {
            // Redirect to immunization.php on success
            header("Location: immunization.php");
            exit();
        } else {
            echo 'Execute failed: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        echo 'Error: Missing form data.';
    }
} else {
    echo 'Error: Form not submitted properly.';
}

$conn->close();
?>
