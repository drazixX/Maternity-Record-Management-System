<?php
// db_connection.php should be included for database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mother_name = $_POST['mother_name'];
    $child_last_name = $_POST['child_last_name'];
    $child_first_name = $_POST['child_first_name'];
    $child_middle_name = $_POST['child_middle_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    $sql = "INSERT INTO child (mother_name, child_last_name, child_first_name, child_middle_name, gender, birth_date, weight, height)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdd", $mother_name, $child_last_name, $child_first_name, $child_middle_name, $gender, $birth_date, $weight, $height);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
