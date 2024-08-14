      <!-- <?php
// Assuming you have started the session and have user information in session variables
session_start();

// Fetch the user_type from the session
$user_type = $_SESSION['user_type'] ?? '';

// You can also fetch it directly from the database if needed
// Example: $user_type = fetchUserTypeFromDatabase($user_id);
?> -->

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
        <style>

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
                        <img src="../asset/img/avatar.png" class="img-circle elevation-2" alt="User Image" width="30" />
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li> -->
                </li>
                <li class="nav-item">
            <button class="nav-link btn btn-link" data-toggle="modal" data-target="#logoutConfirmModal" type="button">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="../index.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>
        
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
  <a href="./backup/backup.php" class="nav-link">
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
<!-- <a class="btn btn-sm elevation-2" href="javascript:history.back()" style="float: right; margin-top: 20px; margin-right: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-arrow-left"></i> Go Back
</a> -->
</div>

                </div>
            </div>
<!-- Table -->
<?php
include 'functions\db_connection.php';

// Get the query parameters
$patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : '';
$selected_month = isset($_GET['month']) ? $_GET['month'] : '';
$selected_year = isset($_GET['year']) ? $_GET['year'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$patient_ids = isset($_GET['patient_ids']) ? $_GET['patient_ids'] : '';

// Start with the base query
$sql = "SELECT * FROM patient WHERE 1=1";

// Initialize parameters and types
$params = [];
$types = '';

// Add filters based on query parameters
if (!empty($patient_id)) {
    $sql .= " AND patient_id = ?";
    $params[] = $patient_id;
    $types .= "s"; // assuming patient_id is a string
}

if (!empty($selected_month) && !empty($selected_year)) {
    $month_number = date('m', strtotime($selected_month));
    $sql .= " AND MONTH(expected_delivery) = ? AND YEAR(expected_delivery) = ?";
    $params[] = $month_number;
    $params[] = $selected_year;
    $types .= "ii"; // assuming selected_month and selected_year are integers
}

if (!empty($patient_ids)) {
    $patient_ids_array = explode(',', $patient_ids);
    $placeholders = implode(',', array_fill(0, count($patient_ids_array), '?'));
    $sql .= " AND patient_id IN ($placeholders)";
    $params = array_merge($params, $patient_ids_array);
    $types .= str_repeat('s', count($patient_ids_array)); // Repeat 's' for each patient_id
}

// Prepare and execute the query
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params); // Unpack the $params array into individual variables
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

<!-- Display Profile Table -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-info elevation-2">
            <div class="card-header">
                <h3 class="card-title">Patient Profile</h3>
                <div class="card-tools">
                    <!-- Print Button -->
                    <button class="btn btn-primary" onclick="printProfile()">Print</button>

                    <!-- Download Button -->
                    <button class="btn btn-success" onclick="downloadProfile()">Download</button>
                </div>
            </div>
            <div class="card-body">
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="row">
                        <!-- Image Section -->
                        <div class="col-md-3 text-center">
                            <img id="profilePhoto" src="<?= htmlspecialchars($row['photo']) ?>" alt="Patient Photo" class="img-fluid img-thumbnail mb-3">
                            <p><strong><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']) ?></strong></p>

                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadPhotoModal">
                                Update Profile Picture
                            </button>
                        </div>

                        <!-- Profile Details -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient ID:</label>
                                        <p><?= htmlspecialchars($row['patient_id']) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact:</label>
                                        <p><?= htmlspecialchars($row['contact']) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Birthdate:</label>
                                        <p><?= htmlspecialchars($row['birthdate']) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Age:</label>
                                        <p><?= htmlspecialchars($row['age']) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Midwife/Nurse/Doctor:</label>
                                        <p><?= htmlspecialchars($row['midwife_nurse_doctor']) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Weight:</label>
                                        <p><?= htmlspecialchars($row['weight']) ?></p>
                                    </div>
                                    <?php if (isset($row['size_of_tummy']) && !empty($row['size_of_tummy'])) : ?>
                                    <div class="form-group">
                                        <label>Size of Tummy:</label>
                                        <p><?= htmlspecialchars($row['size_of_tummy']) ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Additional Profile Details -->
                                <div class="col-md-6">
                                    <?php if (isset($row['prenatal_schedule']) && !empty($row['prenatal_schedule'])) : ?>
                                    <div class="form-group">
                                        <label>Prenatal Schedule:</label>
                                        <p><?= htmlspecialchars($row['prenatal_schedule']) ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($row['expected_delivery']) && !empty($row['expected_delivery'])) : ?>
                                    <div class="form-group">
                                        <label>Expected Delivery:</label>
                                        <p><?= htmlspecialchars($row['expected_delivery']) ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($row['status']) && !empty($row['status'])) : ?>
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <p><?= htmlspecialchars($row['status']) ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($row['height']) && !empty($row['height'])) : ?>
                                    <div class="form-group">
                                        <label>Height:</label>
                                        <p><?= htmlspecialchars($row['height']) ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($row['remarks']) && !empty($row['remarks'])) : ?>
                                    <div class="form-group">
                                        <label>Remarks:</label>
                                        <p><?= htmlspecialchars($row['remarks']) ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (isset($row['lmp']) && !empty($row['lmp'])) : ?>
                                    <div class="form-group">
                                        <label>LMP:</label>
                                        <p><?= htmlspecialchars($row['lmp']) ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <label>Patient Files:</label>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#filesModal" data-id="<?= htmlspecialchars($row['patient_id']) ?>" >Show Files</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Profile Details Continued -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <?php if (isset($row['husband_name']) && !empty($row['husband_name'])) : ?>
                            <div class="form-group">
                                <label>Husband Name:</label>
                                <p><?= htmlspecialchars($row['husband_name']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['plan_to_deliver_at']) && !empty($row['plan_to_deliver_at'])) : ?>
                            <div class="form-group">
                                <label>Plan to Deliver At:</label>
                                <p><?= htmlspecialchars($row['plan_to_deliver_at']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['lmp']) && !empty($row['lmp'])) : ?>
                            <div class="form-group">
                                <label>LMP:</label>
                                <p><?= htmlspecialchars($row['lmp']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['civil_status']) && !empty($row['civil_status'])) : ?>
                            <div class="form-group">
                                <label>Civil Status:</label>
                                <p><?= htmlspecialchars($row['civil_status']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['religion']) && !empty($row['religion'])) : ?>
                            <div class="form-group">
                                <label>Religion:</label>
                                <p><?= htmlspecialchars($row['religion']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['educ_level']) && !empty($row['educ_level'])) : ?>
                            <div class="form-group">
                                <label>Educational Level:</label>
                                <p><?= htmlspecialchars($row['educ_level']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['occupation']) && !empty($row['occupation'])) : ?>
                            <div class="form-group">
                                <label>Occupation:</label>
                                <p><?= htmlspecialchars($row['occupation']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['monthly_income']) && !empty($row['monthly_income'])) : ?>
                            <div class="form-group">
                                <label>Monthly Income:</label>
                                <p><?= htmlspecialchars($row['monthly_income']) ?></p>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($row['blood_type']) && !empty($row['blood_type'])) : ?>
                            <div class="form-group">
                                <label>Blood Type:</label>
                                <p><?= htmlspecialchars($row['blood_type']) ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>


<!-- Modal for Uploading/Changing Photo -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" role="dialog" aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadPhotoModalLabel">Upload/Change Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadPhotoForm" action="upload_photo.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="patient_id" value="<?= htmlspecialchars($row['patient_id']) ?>">
                    <div class="form-group">
                        <label for="photo" class="col-form-label">Choose Photo (JPG format only)</label>
                        <input type="file" name="photo" accept="image/jpeg" class="form-control-file" id="photo">
                    </div>
                    <button type="submit" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Files Modal -->
<div class="modal fade" id="filesModal" tabindex="-1" role="dialog" aria-labelledby="filesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filesModalLabel">Patient Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="filesTable">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>File Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="filesList">
                            <!-- Files will be loaded here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .modal-dialog {
        max-width: 90%; /* Adjust width as needed */
    }
    
    .table thead th {
        background-color: #f8f9fa;
    }
    
    .table td, .table th {
        vertical-align: middle;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
    
    .btn-download {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }
</style>




<style>
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on touch devices */
    }
    .table {
        min-width: 1000px; /* Adjust based on your table's width */
    }
</style>


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


<!-- jsPDF and autoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.6.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

<!-- docx -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/docx/7.4.3/docx.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>


<!-- For FIles displaying -->
<script>
    $('#filesModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var patientId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);

        // Load files via AJAX
        $.ajax({
            url: 'fetch_files.php',
            type: 'GET',
            data: { patient_id: patientId },
            dataType: 'json',
            success: function(response) {
                var filesList = $('#filesList');
                filesList.empty(); // Clear previous files

                if (response.length > 0) {
                    response.forEach(function(file) {
                        var fileRow = $('<tr></tr>');
                        var fileNameCell = $('<td></td>').text(file.file_name);
                        var fileTypeCell = $('<td></td>').text(file.file_type);
                        var actionsCell = $('<td></td>');

                        var downloadButton = $('<a></a>')
                            .attr('href', 'download.php?file=' + encodeURIComponent(file.file_name))
                            .attr('class', 'btn btn-primary btn-sm')
                            .attr('role', 'button')
                            .text('Download');

                        var deleteButton = $('<button></button>')
                            .attr('class', 'btn btn-danger btn-sm ml-2')
                            .text('Delete')
                            .click(function() {
                                // Handle file deletion
                                if (confirm('Are you sure you want to delete this file?')) {
                                    $.ajax({
                                        url: 'delete_file.php',
                                        type: 'POST',
                                        data: { file_name: file.file_name, patient_id: patientId },
                                        success: function(result) {
                                            if (result === 'success') {
                                                fileRow.remove();
                                            } else {
                                                alert('Error deleting file.');
                                            }
                                        },
                                        error: function() {
                                            alert('Error deleting file.');
                                        }
                                    });
                                }
                            });

                        actionsCell.append(downloadButton).append(deleteButton);
                        fileRow.append(fileNameCell).append(fileTypeCell).append(actionsCell);
                        filesList.append(fileRow);
                    });
                } else {
                    filesList.html('<tr><td colspan="3">No files found</td></tr>');
                }
            },
            error: function() {
                $('#filesList').html('<tr><td colspan="3">An error occurred while loading files.</td></tr>');
            }
        });
    });
</script>



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
   <!-- For print and download profile -->
 <script>
        function printProfile() {
    // Select the elements you want to hide during printing
    var fileInput = document.querySelector('input[type="file"]');
    var uploadButton = document.querySelector('button.upload-photo');
    var showFilesButton = document.querySelector('button.show-files');

    // Hide the elements
    if (fileInput) fileInput.style.display = 'none';
    if (uploadButton) uploadButton.style.display = 'none';
    if (showFilesButton) showFilesButton.style.display = 'none';

    // Get the content of the card body
    var printContent = document.querySelector('.card-body').innerHTML;

    // Add the header content
    var headerContent = '<h2 style="text-align: center;">Profile Report</h2>';

    // Combine the header and the card body content
    var combinedContent = headerContent + printContent;

    // Store the original content of the page
    var originalContent = document.body.innerHTML;

    // Replace the body's content with the combined content
    document.body.innerHTML = combinedContent;

    // Trigger the print dialog
    window.print();

    // Restore the original content of the page
    document.body.innerHTML = originalContent;

    // Restore the visibility of the elements
    if (fileInput) fileInput.style.display = '';
    if (uploadButton) uploadButton.style.display = '';
    if (showFilesButton) showFilesButton.style.display = '';
}

        async function downloadProfile() {
    const { jsPDF } = window.jspdf;

    // Select the element containing the profile information
    const element = document.querySelector('.card-body');

    // Use html2canvas to capture the content of the element
    html2canvas(element).then(canvas => {
        const imgData = canvas.toDataURL('image/png'); // Convert canvas to image data URL
        const doc = new jsPDF();
        
        // Add the image to the PDF
        doc.addImage(imgData, 'PNG', 10, 10, 190, 0); // Adjust dimensions and position as needed

        // Save the PDF with a filename
        doc.save('patient-profile.pdf');
    }).catch(err => {
        console.error('Error capturing the content:', err);
    });
}

    </script>

<script>
function downloadTable() {
    var csv = [];
    var rows = document.querySelectorAll("#example1 tr");

    // Add the header row with "Profile Report"
    csv.push("Profile Report");

    // Add a blank line after the header for better formatting (optional)
    csv.push("Profile Report");

    // Process the table rows
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++) {
            row.push(cols[j].innerText);
        }

        csv.push(row.join(","));
    }

    // Create and download the CSV file
    var csv_file = new Blob([csv.join("\n")], { type: "text/csv" });
    var download_link = document.createElement("a");
    download_link.download = "patients_data.csv";
    download_link.href = window.URL.createObjectURL(csv_file);
    download_link.style.display = "none";
    document.body.appendChild(download_link);
    download_link.click();
}
</script>



<!-- For uploading profile photo -->

<script>
$(document).ready(function() {
    $('#uploadPhotoForm').on('submit', function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: 'upload_photo.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Update the profile photo src
                    $('#profilePhoto').attr('src', response.photo + '?' + new Date().getTime());
                    // Close the modal
                    $('#uploadPhotoModal').modal('hide');
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while uploading the photo.');
            }
        });
    });
});
</script>


</body>
</html>
