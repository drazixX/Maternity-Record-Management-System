<?php
// Establish database connection
$mysqli = new mysqli('localhost', 'root', '', 'mrm'); // Update with your database credentials

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to fetch patient data without height
$query = "SELECT 
              patient_id,
              CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) AS full_name,
              contact,
              address,
              created_at AS date_check_in,
              age,
              status
          FROM 
              patient";

// Execute query
$result = $mysqli->query($query);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $statusBadge = $row['status'] == 'Active' ? 'bg-success' : 'bg-danger';
        echo "<tr>";
        echo "<td><a href='prenatal.php?patient_id=" . urlencode($row['patient_id']) . "'>" . htmlspecialchars($row['patient_id']) . "</a></td>";
        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "<td>" . date('d-m-Y', strtotime($row['date_check_in'])) . "</td>";
        echo "<td>" . htmlspecialchars($row['age']) . "</td>";
        echo "<td><span class='badge " . $statusBadge . "'>" . htmlspecialchars($row['status']) . "</span></td>";
        echo "<td class='text-right'>";
        echo "<a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-id='" . htmlspecialchars($row['patient_id']) . "'><i class='fa fa-pen'></i></a>";
        echo "<a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#delete'><i class='fa fa-trash'></i></a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}

// Close the database connection
$mysqli->close();
?>
