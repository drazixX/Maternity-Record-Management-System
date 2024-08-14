
<?php
// Assuming you have started the session and have user information in session variables
session_start();

// Fetch the user_type from the session
$user_type = $_SESSION['user_type'] ?? '';

// You can also fetch it directly from the database if needed
// Example: $user_type = fetchUserTypeFromDatabase($user_id);
?>

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
    <link
      rel="stylesheet"
      href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style type="text/css">
        td p {
            margin: 2px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
      <nav
        class="main-header navbar navbar-expand navbar-light elevation-1"
        style="background-color: rgba(131, 219, 214)"
      >
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        
<!-- For notif -->
<?php
// Include the notifications fetching script
include 'fetch_notifications.php';
?>
<!-- For notif icon -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button">
        <i class="fas fa-bell"></i>
        <span class="badge badge-warning navbar-badge"><?php echo count($notifications); ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <?php if (count($notifications) > 0): ?>
            <?php foreach ($notifications as $notification): ?>
                <a href="prenatal.php?patient_id=<?php echo htmlspecialchars($notification['patient_id']); ?>" class="dropdown-item">
                    <div class="media">
                        <!-- <img src="path/to/avatar.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Appointment for <?php echo htmlspecialchars($notification['patient_name']); ?>
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Scheduled for: <?php echo date('d-m-Y', strtotime($notification['prenatal_schedule'])); ?></p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 1 week from now</p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            <div class="dropdown-divider"></div>
        <?php else: ?>
            <a href="#" class="dropdown-item">No upcoming appointments</a>
        <?php endif; ?>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>


          <li class="nav-item">
            <a class="nav-link" href="#" role="button">
              <img
                src="../asset/img/avatar.png"
                class="img-circle elevation-2"
                alt="User Image"
                width="30"
              />
            </a>
          </li>
          
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li> -->
         <!-- Logout Button -->
         <li class="nav-item">
            <button class="nav-link btn btn-link" data-toggle="modal" data-target="#logoutConfirmModal" type="button">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </li>
          
        </ul>
      </nav>

<aside
  class="main-sidebar sidebar-light-primary elevation-2"
  style="background-color: rgba(62, 88, 113)"
>
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link animated swing">
    <img src="../asset/img/clinic-logo.png" alt="DSMS Logo" width="200" />
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul
        class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false"
      >
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
        <?php if ($user_type !== 'staff'): ?>
        <li class="nav-item">
          <a href="midwives.php" class="nav-link">
            <i class="nav-icon fa fa-hospital-user"></i>
            <p>Midwives</p>
          </a>
        </li>
        <?php endif; ?>
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
  <a href="#" class="nav-link" onclick="toggleSubMenu(this)">
    <i class="nav-icon fa fa-chart-pie"></i>
    <p>Reports<i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview" style="display: none;">
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
    <li class="nav-item">
      <a href="children-report.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Children per month</p>
      </a>
    </li>
  </ul>
</li>

<script>
  function toggleSubMenu(element) {
    var submenu = element.nextElementSibling;
    if (submenu.style.display === "none" || submenu.style.display === "") {
      submenu.style.display = "block";
    } else {
      submenu.style.display = "none";
    }
  }
</script>

<style>
  .nav-treeview {
    padding-left: 20px;
  }
</style>

<li class="nav-item">
  <a href="#" class="nav-link" onclick="toggleSubMenu(this)">
    <i class="nav-icon fa fa-archive"></i>
    <p>Archives<i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview" style="display: none;">
    <li class="nav-item">
      <a href="archive_patient.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Prenatal Patients</p>
      </a>
    </li>
    <?php if ($user_type !== 'staff'): ?>
    <li class="nav-item">
      <a href="archive_midwives.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Midwives</p>
      </a>
    </li>
    <?php endif; ?>
    <li class="nav-item">
      <a href="archive_child.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Child</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="archive_immunization.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Immunization</p>
      </a>
    </li>
  </ul>
</li>

<script>
  function toggleSubMenu(element) {
    var submenu = element.nextElementSibling;
    if (submenu.style.display === "none" || submenu.style.display === "") {
      submenu.style.display = "block";
    } else {
      submenu.style.display = "none";
    }
  }
</script>

<style>
  .nav-treeview {
    padding-left: 20px;
  }
</style>
<li class="nav-item">
  <a href="#" class="nav-link" onclick="toggleSubMenu(this)">
    <i class="nav-icon fa fa-tools"></i>
    <p>Maintenance<i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview" style="display: none;">
    <?php if ($user_type !== 'staff'): ?>
      <li class="nav-item">
        <a href="user.php" class="nav-link">
          <i class="nav-icon far fa-circle"></i>
          <p>Users</p>
        </a>
      </li>
    <?php endif; ?>
    <li class="nav-item">
      <a href="" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Backup</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="restore.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Restore</p>
      </a>
    </li>
  </ul>
</li>

<script>
  function toggleSubMenu(element) {
    var submenu = element.nextElementSibling;
    if (submenu.style.display === "none" || submenu.style.display === "") {
      submenu.style.display = "block";
    } else {
      submenu.style.display = "none";
    }
  }
</script>

<style>
  .nav-treeview {
    padding-left: 20px;
  }
</style>

          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
    <div class="wrapper">
        <!-- Navbar and Sidebar omitted for brevity -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                <span class="fa fa-child"></span> Appointments
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Appointments</li>
                            </ol>
                        </div>
                        <a class="btn btn-sm elevation-2" href="#" data-toggle="modal" data-target="#add" style="margin-top: 20px; margin-left: 10px; background-color: rgba(131, 219, 214);"><i class="fa fa-plus"></i> Set Schedule</a>
                        <!-- <a class="btn btn-sm elevation-2" href="javascript:history.back()" style="float: left; margin-top: 20px; margin-left: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-arrow-left"></i> Go Back
</a> -->
                    </div>
                </div>
            </div>

            <!-- Modal structure -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addPrenatalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPrenatalModalLabel">Add Prenatal Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPrenatalForm">
                    <div class="form-group">
                        <label for="patient_id">Patient ID</label>
                        <input type="text" class="form-control" id="patient_id" name="patient_id" oninput="fetchPatientName()">
                    </div>
                    <div class="form-group">
                        <label for="patient_name">Patient Name</label>
                        <input type="text" class="form-control" id="patient_name" name="patient_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prenatal_schedule">Prenatal Schedule</label>
                        <input type="date" class="form-control" id="prenatal_schedule" name="prenatal_schedule">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitPrenatalForm()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--  -->
<?php
include 'functions/db_connection.php';

// Get filter parameters
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

// Start building the SQL query
$sql = "SELECT patient_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS patient_name, prenatal_schedule FROM patient WHERE 1=1";

// Add filtering conditions
if ($month && $year) {
    $sql .= " AND DATE_FORMAT(prenatal_schedule, '%M') = ? AND DATE_FORMAT(prenatal_schedule, '%Y') = ?";
} elseif ($month) {
    $sql .= " AND DATE_FORMAT(prenatal_schedule, '%M') = ?";
} elseif ($year) {
    $sql .= " AND DATE_FORMAT(prenatal_schedule, '%Y') = ?";
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

if ($month && $year) {
    $stmt->bind_param('ss', $month, $year);
} elseif ($month) {
    $stmt->bind_param('s', $month);
} elseif ($year) {
    $stmt->bind_param('s', $year);
}

// Execute the statement and fetch results
$stmt->execute();
$result = $stmt->get_result();

// Generate the table HTML
if ($result->num_rows > 0) {
 
echo '<section class="content">
<div class="container-fluid">
    <div class="card card-info elevation-2">
        <br />
        <div class="col-md-12">
            <!-- Search Input and Buttons Row -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <div class="col-md-9 text-right">
                    <button id="printButton" class="btn btn-primary">Print</button>
                    <button id="downloadButton" class="btn btn-secondary">Download</button>
                </div>
            </div>
            
            <!-- Table -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Schedule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

while ($row = $result->fetch_assoc()) {
$showButton = !is_null($row["prenatal_schedule"]); // Check if prenatal_schedule is not NULL

echo '<tr>
        <td>' . htmlspecialchars($row["patient_id"]) . '</td>
        <td>' . htmlspecialchars($row["patient_name"]) . '</td>
        <td>' . htmlspecialchars($row["prenatal_schedule"]) . '</td>
        <td class="text-right">';

if ($showButton) {
    echo '<a class="btn btn-sm btn-danger cancel-schedule-btn" href="#" data-id="' . htmlspecialchars($row["patient_id"]) . '" data-toggle="modal" data-target="#cancel-schedule" title="Cancel"><i class="fa fa-trash"></i></a>';
}

echo '  </td>
    </tr>';
}

echo '      </tbody>
        </table>
    </div>
</div>
</div>
</section>';
} else {
  echo '<section class="content"><div class="container-fluid"><div class="card card-info elevation-2"><br /><div class="col-md-12"><p>No records found</p></div></div></div></section>';
}

// Clean up
$stmt->close();
$conn->close();
?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Print button functionality
    document.getElementById('printButton').addEventListener('click', function () {
        // Get references to the buttons
        var printButton = document.getElementById('printButton');
        var downloadButton = document.getElementById('downloadButton');
        var searchInput = document.getElementById('searchInput');

        // Hide the buttons and search input before printing
        printButton.style.display = 'none';
        downloadButton.style.display = 'none';
        searchInput.style.display = 'none';

        // Open a new window for printing
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print</title>');
        
        // Optional: Add some basic styling for the print header
        printWindow.document.write('<style>');
        printWindow.document.write('h1 { text-align: center; margin-bottom: 20px; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; }');
        printWindow.document.write('table, th, td { border: 1px solid black; padding: 8px; text-align: left; }');
        printWindow.document.write('</style>');

        printWindow.document.write('</head><body>');
        
        // Add the header to the print view
        printWindow.document.write('<h1>Appointments</h1>');

        // Write the content of the table to the new window
        printWindow.document.write(document.querySelector('table').outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();

        // Restore the buttons and search input after printing
        printButton.style.display = '';
        downloadButton.style.display = '';
        searchInput.style.display = '';
    });





    // Download button functionality
    document.getElementById('downloadButton').addEventListener('click', function () {
        var tableHTML = document.querySelector('table').outerHTML;
        var blob = new Blob([tableHTML], { type: 'application/vnd.ms-excel' });
        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'patient_data.xls';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});
</script>


<!-- Cancel Schedule Modal -->
<div id="cancel-schedule" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="../asset/img/sent.png" alt="" width="50" height="46" />
                <h3>Are you sure you want to cancel this schedule?</h3>
                <div class="mt-3">
                    <form action="cancel_schedule.php" method="POST">
                        <input type="hidden" name="schedule_id" id="scheduleId" value="">
                        <button type="submit" class="btn btn-danger">Cancel Schedule</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





    <!-- Modals omitted for brevity -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="../asset/jquery/jquery.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/adminlte.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <!-- Custom JS -->

    <!-- For search bar functionality -->
     <!-- JavaScript for Search Functionality -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchTerm = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('#example1 tbody tr');

        tableRows.forEach(function(row) {
            var rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
    <script>


    // For table
    function fetchPatientName() {
        var patientId = document.getElementById("patient_id").value;
        if (patientId.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_patient_name.php?patient_id=" + patientId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("patient_name").value = xhr.responseText;
                }
            };
            xhr.send();
        } else {
            document.getElementById("patient_name").value = "";
        }
    }

    function submitPrenatalForm() {
        var form = document.getElementById('addPrenatalForm');
        var formData = new FormData(form);
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "functions/save_prenatal_schedule.php", true); // Updated path
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert('Prenatal schedule saved successfully!');
                $('#add').modal('hide');
                location.reload(); // Reload the page to reflect changes
            }
        };
        xhr.send(formData);
    }
    </script>
<script>
$(document).ready(function() {
    // Function to open the modal and set the schedule_id
    $('.cancel-schedule-btn').click(function() {
        var scheduleId = $(this).data('id');
        $('#scheduleId').val(scheduleId); // Set the value of the hidden input
    });
});
</script>


<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

</body>
</html>
