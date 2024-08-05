<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mrm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$mother_name = $_POST['mother_name'];
$child_last_name = $_POST['child_last_name'];
$child_first_name = $_POST['child_first_name'];
$child_middle_name = $_POST['child_middle_name'];
$gender = $_POST['gender'];
$birth_date = $_POST['birth_date'];
$weight = $_POST['weight'];
$height = $_POST['height'];

// Prepare SQL statement
$sql = "INSERT INTO child (mother_name, child_last_name, child_first_name, child_middle_name, gender, birth_date, weight, height)
        VALUES ('$mother_name', '$child_last_name', '$child_first_name', '$child_middle_name', '$gender', '$birth_date', '$weight', '$height')";

// Execute query
if ($conn->query($sql) === TRUE) {
    // Success
    echo "<script>
            alert('New record created successfully');
            window.location.href = 'child.php';
          </script>";
} else {
    // Error
    echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'child.php';
          </script>";
}

// Close connection
$conn->close();
?>
