<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Maternity-Record-Management-System</title>
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/MRM/asset/img/baby1.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../asset/css/adminlte.min.css" />
    <link rel="stylesheet" href="../asset/css/style.css" />
    <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <style type="text/css">
        td p {
            margin: 2px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-light elevation-1" style="background-color: rgba(131, 219, 214)">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <img src="../asset/img/avatar.png" class="img-circle elevation-2" alt="User Image" width="30" />
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                </li>
<!-- Logout Button -->
<li class="nav-item">
  <a class="nav-link" data-toggle="modal" data-target="#logoutConfirmModal">
    <i class="fas fa-sign-out-alt"></i> Logout
  </a>
</li>
            </ul>
        </nav>
        <!-- Logout Confirmation Modal -->
<div id="logoutConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutConfirmLabel">Confirm Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to log out?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
        <a href="../index.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>
        <aside class="main-sidebar sidebar-light-primary elevation-2" style="background-color: rgba(62, 88, 113)">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link animated swing">
                <img src="../asset/img/clinic-logo.png" alt="DSMS Logo" width="200" />
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="patient.php" class="nav-link">
                                <i class="nav-icon fa fa-hospital-user"></i>
                                <p>Prenatal Patients</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="prenatal.php" class="nav-link">
                                <i class="nav-icon fa fa-child"></i>
                                <p>Prenatal Records</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="appointment.php" class="nav-link">
                                <i class="nav-icon fa fa-calendar-alt"></i>
                                <p>Appointments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="midwives.php" class="nav-link">
                                <i class="nav-icon fa fa-hospital-user"></i>
                                <p>Midwives</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="child.php" class="nav-link">
                                <i class="nav-icon fa fa-baby"></i>
                                <p>Child Records</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="immunization.php" class="nav-link">
                                <i class="nav-icon fa fa-syringe"></i>
                                <p>Immunization Records</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-chart-pie"></i>
                                <p>Reports</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prenatal-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Prenatal Per Month</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="vaccinated-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Vaccinated Children</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-archive"></i>
                                <p>Archives</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prenatal-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Patient</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="vaccinated-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Midwives</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="vaccinated-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Child</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-tools"></i>
                                <p>Maintenance</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="prenatal-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="vaccinated-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Backup</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="vaccinated-report.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Restore</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                <span class="fa fa-child"></span> Prenatal Records
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Prenatal</li>
                            </ol>
                        </div>
<a class="btn btn-sm elevation-2" href="javascript:history.back()" style="float: right; margin-top: 20px; margin-right: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-arrow-left"></i> Go Back
</a>
</div>

                </div>
            </div>
            <!-- Table -->
            <?php
include 'C:\xampp\htdocs\MRM\admin\functions\db_connection.php';

// Get the query parameters
$patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : '';
$selected_month = isset($_GET['month']) ? $_GET['month'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Start with the base query
$sql = "SELECT * FROM patient WHERE 1=1";

// Initialize parameters and types
$params = [];
$types = [];

// Add filters based on query parameters
if (!empty($patient_id)) {
    $sql .= " AND patient_id = ?";
    $params[] = $patient_id;
    $types[] = "s"; // assuming patient_id is a string
}

if (!empty($selected_month)) {
    $sql .= " AND MONTHNAME(expected_delivery) = ?";
    $params[] = $selected_month;
    $types[] = "s"; // assuming selected_month is a string
}

if (!empty($status)) {
    // Handle NULL values as a special case
    if ($status === 'NULL') {
        $sql .= " AND status IS NULL";
    } else {
        $sql .= " AND status = ?";
        $params[] = $status;
        $types[] = "s"; // assuming status is a string
    }
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

if (!empty($params)) {
    $stmt->bind_param(implode('', $types), ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Check for query errors
if (!$result) {
    die('Query Error: ' . htmlspecialchars($conn->error));
}

// Check if there are results
if ($result->num_rows === 0) {
    echo "No data available in table.";
}
?>


<section class="content">
    <div class="container-fluid">
        <div class="card card-info elevation-2">
            <div class="card-header">
                <h3 class="card-title">Patient Records</h3>
                <div class="card-tools">
                    <!-- Print Button -->
                    <button class="btn btn-primary" onclick="printTable()">Print</button>
                    <!-- Download Button -->
                    <button class="btn btn-success" onclick="downloadTable()">Download</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Midwife/Nurse/Doctor</th>
                                <th>Weight</th>
                                <th>Size of Tummy</th>
                                <th>BP</th>
                                <th>PR</th>
                                <th>RR</th>
                                <th>FH</th>
                                <th>FHT</th>
                                <th>AOG</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Prenatal Schedule</th>
                                <th>Expected Delivery</th>
                                <th>Status</th>
                                <th>Height</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['patient_id']) ?></td>
                                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></td>
                                    <td><?= htmlspecialchars($row['contact']) ?></td>
                                    <td><?= htmlspecialchars($row['birthdate']) ?></td>
                                    <td><?= htmlspecialchars($row['age']) ?></td>
                                    <td><?= htmlspecialchars($row['midwife_nurse_doctor']) ?></td>
                                    <td><?= htmlspecialchars($row['weight']) ?></td>
                                    <td><?= htmlspecialchars($row['size_of_tummy']) ?></td>
                                    <td><?= htmlspecialchars($row['bp']) ?></td>
                                    <td><?= htmlspecialchars($row['pr']) ?></td>
                                    <td><?= htmlspecialchars($row['rr']) ?></td>
                                    <td><?= htmlspecialchars($row['fh']) ?></td>
                                    <td><?= htmlspecialchars($row['fht']) ?></td>
                                    <td><?= htmlspecialchars($row['aog']) ?></td>
                                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td><?= htmlspecialchars($row['updated_at']) ?></td>
                                    <td><?= htmlspecialchars($row['prenatal_schedule']) ?></td>
                                    <td><?= htmlspecialchars($row['expected_delivery']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td><?= htmlspecialchars($row['height']) ?></td>
                                    <td><?= htmlspecialchars($row['remarks']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add some custom CSS for better table styling -->
<style>
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
    </style>


<!-- Include jQuery and Bootstrap JavaScript if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../asset/jquery/jquery.min.js"></script>
    <script src="../asset/js/adminlte.js"></script>
    <script src="../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../asset/tables/jszip/jszip.min.js"></script>
    <script src="../asset/tables/pdfmake/pdfmake.min.js"></script>
    <script src="../asset/tables/pdfmake/vfs_fonts.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
function printTable() {
    var printWindow = window.open('', '', 'height=600,width=800');
    var table = document.getElementById('example1').outerHTML;
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
    printWindow.document.write('</head><body >');
    printWindow.document.write(table);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function downloadTable() {
    var csv = [];
    var rows = document.querySelectorAll("#example1 tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++) {
            row.push(cols[j].innerText);
        }

        csv.push(row.join(","));
    }

    var csv_file = new Blob([csv.join("\n")], { type: "text/csv" });
    var download_link = document.createElement("a");
    download_link.download = "patients_data.csv";
    download_link.href = window.URL.createObjectURL(csv_file);
    download_link.style.display = "none";
    document.body.appendChild(download_link);
    download_link.click();
}
</script>

</body>
</html>
