<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your password if applicable
$database = "mrm";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT patient_id, bp, pr, rr, fh, fht, aog, size_of_tummy, weight, birthdate, expected_delivery FROM patient";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<section class="content">
            <div class="container-fluid">
                <div class="card card-info elevation-2">
                    <br />
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Patient ID</th>
                                    <th>Vitals</th>
                                    <th>Size of tummy</th>
                                    <th>Weight</th>
                                    <th>Birthdate</th>
                                    <th>Expected delivery</th>
                                </tr>
                            </thead>
                            <tbody>';

    while($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row["patient_id"]) . '</td>
                <td>
                    <p class="info">
                        <small>Blood Pressure: <b>' . htmlspecialchars($row["bp"]) . '</b></small>
                    </p>
                    <p class="info">
                        <small>Pulse Rate: <b>' . htmlspecialchars($row["pr"]) . '</b></small>
                    </p>
                    <p class="info">
                        <small>Respiratory Rate: <b>' . htmlspecialchars($row["rr"]) . '</b></small>
                    </p>
                    <p class="info">
                        <small>FH: <b>' . htmlspecialchars($row["fh"]) . '</b></small>
                    </p>
                    <p class="info">
                        <small>FHT: <b>' . htmlspecialchars($row["fht"]) . '</b></small>
                    </p>
                    <p class="info">
                        <small>AOG: <b>' . htmlspecialchars($row["aog"]) . '</b></small>
                    </p>
                </td>
                <td>' . htmlspecialchars($row["size_of_tummy"]) . '</td>
                <td>' . htmlspecialchars($row["weight"]) . 'kg</td>
                <td>' . htmlspecialchars($row["birthdate"]) . '</td>
                <td>' . htmlspecialchars($row["expected_delivery"]) . '</td>

            </tr>';
    }

    echo '          </tbody>
                </table>
            </div>
        </div>
    </div>
</section>';
} else {
    echo "0 results";
}

$conn->close();
?>
