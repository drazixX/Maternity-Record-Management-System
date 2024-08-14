<?php
// Database connection
include 'functions/db_connection.php';

// Get today's date
$today = new DateTime();

// Calculate the date one week from now
$oneWeekFromNow = (clone $today)->add(new DateInterval('P7D'));

// Format the date for comparison (assuming your date format is 'Y-m-d')
$oneWeekFromNowFormatted = $oneWeekFromNow->format('Y-m-d');

// Fetch notifications (appointments scheduled exactly one week from now)
$query = "SELECT patient_id, first_name, last_name, prenatal_schedule 
          FROM patient 
          WHERE DATE(prenatal_schedule) = '$oneWeekFromNowFormatted'
          ORDER BY prenatal_schedule ASC";
$result = $conn->query($query);

$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = [
            'patient_id' => $row['patient_id'],
            'patient_name' => $row['first_name'] . ' ' . $row['last_name'],
            'prenatal_schedule' => $row['prenatal_schedule']
        ];
    }
}

// Close the database connection
$conn->close();
?>
