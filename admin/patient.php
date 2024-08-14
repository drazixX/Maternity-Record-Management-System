<?php
// Assuming you have started the session and have user information in session variables
session_start();

// Fetch the user_type from the session
$user_type = $_SESSION['user_type'] ?? '';

// You can also fetch it directly from the database if needed
// Example: $user_type = fetchUserTypeFromDatabase($user_id);
?>

<?php
// Assuming you have a database connection file included
include 'functions/db_connection.php';

// Query to fetch active midwives
$sql = "SELECT midwife_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name FROM midwife WHERE status = 'Active'";
$result = $conn->query($sql);

$midwives = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $midwives[] = $row;
    }
}
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
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- DataTables CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"
    />


    <style>
      .custom-width {
        width: 10%; /* Adjust if needed */
        margin-bottom: 10px; /* Space between inputs */
      }
    </style>
        <style>
  .fas.fa-bell {
    font-size: 1.1em; /* Adjust the size of the icon */
    color: #727c7d; /* Change this color if needed */
    position: relative;
  }

  .navbar-badge {
    font-size: 0.6em; /* Adjust the size of the badge */
    position: absolute;
    top: 5px; /* Positioning the badge relative to the icon */
    right: -3px;
    background-color: #ffc107; /* Badge color */
    color: #090a0a; /* Badge text color */
    border-radius: 2%;
    padding: 2px 5px;
  }

  .nav-link[data-toggle="dropdown"]:hover {
    color: #000; /* Ensure the icon is visible on hover */
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
            <li class="nav-item">
      <a href="children-report.php" class="nav-link">
        <i class="nav-icon far fa-circle"></i>
        <p>Children per month</p>
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
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-tools"></i>
            <p>Maintenance</p>
            <i class="right fas fa-angle-left"></i>
          </a>
          
          <ul class="nav nav-treeview">
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
      </ul>
    </nav>
  </div>
</aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">
                  <span class="fa fa-hospital-user"></span> Patients List
                </h1>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Prenatal Patients</li>
                </ol>
              </div>
              <!-- /.col -->
              <a
                class="btn btn-sm elevation-2"
                href="#"
                data-toggle="modal"
                data-target="#add"
                style="
                  margin-top: 20px;
                  margin-left: 10px;
                  background-color: rgba(131, 219, 214);
                "
                ><i class="fa fa-plus"></i> Add New</a
              >
              <!-- <a class="btn btn-sm elevation-2" href="javascript:history.back()" style="float: left; margin-top: 20px; margin-left: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-arrow-left"></i> Go Back
</a> -->

              <!-- <a
    class="btn btn-sm elevation-2"
    href="prenatal.php"
    style="
        margin-top: 20px;
        margin-left: 10px;
        background-color: rgba(131, 219, 214);
    "
><i class="fa fa-info-circle"></i> More Information</a> -->

            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <?php
// Establish database connection
$mysqli = new mysqli('localhost', 'root', '', 'mrm'); // Update with your database credentials

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get search term from GET request
$search = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '%';

// Pagination
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query to fetch patient data with search and pagination
$query = "SELECT 
              patient_id,
              CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) AS full_name,
              address,
              age,
              status
          FROM 
              patient
          WHERE
              patient_id LIKE ?
              OR CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) LIKE ?
              OR address LIKE ?
              OR age LIKE ?
          LIMIT ? OFFSET ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param('ssssii', $search, $search, $search, $search, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch total number of records for pagination
$countQuery = "SELECT COUNT(*) AS total FROM patient WHERE patient_id LIKE ? OR CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) LIKE ? OR address LIKE ? OR age LIKE ?";
$countStmt = $mysqli->prepare($countQuery);
$countStmt->bind_param('ssss', $search, $search, $search, $search);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$stmt->close();
$countStmt->close();
$mysqli->close();
?>
<!-- Display table -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-info elevation-2">
            <div class="col-md-12">
                <!-- Search Form -->
                <div class="row mb-3">
                    <div class="col-md-2 ml-auto">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                    </div>
                </div>

                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th title="Click to show full details">Patient ID</th>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display rows
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $statusBadge = $row['status'] == 'Active' ? 'bg-success' : 'bg-danger';
                                    echo "<tr>";
                                    echo "<td><a href='prenatal.php?patient_id=" . urlencode($row['patient_id']) . "' title='Click to show full details'>" . htmlspecialchars($row['patient_id'], ENT_QUOTES) . "</a></td>";
                                    echo "<td>" . htmlspecialchars($row['full_name'], ENT_QUOTES) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['address'], ENT_QUOTES) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['age'], ENT_QUOTES) . "</td>";
                                    echo "<td><span class='badge " . $statusBadge . "'>" . htmlspecialchars($row['status'], ENT_QUOTES) . "</span></td>";
                                    echo "<td class='text-right'>";
                                    echo "<a class='btn btn-sm btn-success' href='#' data-toggle='modal' data-target='#edit' data-id='" . htmlspecialchars($row['patient_id'], ENT_QUOTES) . "' data-toggle='tooltip' title='Edit'><i class='fa fa-pen'></i></a>";
                                    echo "<a class='btn btn-sm btn-info' href='#' data-toggle='modal' data-target='#uploadFiles' data-id='" . htmlspecialchars($row['patient_id'], ENT_QUOTES) . "' data-toggle='tooltip' title='Upload Files'><i class='fa fa-upload'></i></a>";
                                    echo "<a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#delete' data-id='" . htmlspecialchars($row['patient_id'], ENT_QUOTES) . "' data-toggle='tooltip' title='Delete'><i class='fa fa-trash'></i></a>";                                                               
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- End of table-responsive -->
            </div>
        </div>
    </div>
</section>


<!-- Upload Files Modal -->
<div class="modal fade" id="uploadFiles" tabindex="-1" role="dialog" aria-labelledby="uploadFilesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFilesLabel">Upload Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="fileUploadForm" method="POST" enctype="multipart/form-data" action="upload_files.php">
    <input type="hidden" name="patient_id" id="uploadPatientId" value="">
    <div class="form-group">
        <label for="file">Choose file</label>
        <input type="file" class="form-control" id="file" name="file">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

            </div>
        </div>
    </div>
</div>



                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?search=<?php echo urlencode($_GET['search'] ?? ''); ?>&page=<?php echo $page - 1; ?>">Previous</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="?search=<?php echo urlencode($_GET['search'] ?? ''); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item"><a class="page-link" href="?search=<?php echo urlencode($_GET['search'] ?? ''); ?>&page=<?php echo $page + 1; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>


<!-- Delete modal -->
<div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="../asset/img/sent.png" alt="" width="50" height="46" />
                <h3>Are you sure you want to archive this Patient?</h3>
                <div class="m-t-20">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <form action="move_to_archive.php" method="POST" style="display: inline;">
                        <input type="hidden" name="patient_id" id="patient_id" value="">
                        <button type="submit" class="btn btn-danger delete-btn">Archive</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SEPARATE MODAL for adding -->
<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <span class="fa fa-hospital-user"></span> Patient Information
        </h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./functions/save_patient.php" method="POST">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>First Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="first_name"
                  placeholder="First Name"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Middle Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="middle_name"
                  placeholder="Middle Name"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Last Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="last_name"
                  placeholder="Last Name"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Contact</label>
                <input
                  type="text"
                  class="form-control"
                  name="contact"
                  placeholder="Contact"
                  required 
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Birthdate</label>
                <input type="date" class="form-control" name="birthdate" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                  <option value="">Select Status</option>
                  <option value="Pregnant">Pregnant</option>
                  <option value="Delivered">Delivered</option>
                  <option value="Delivered_other">Delivered(Not in Clinic)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Address</label>
                <textarea
                  class="form-control"
                  name="address"
                  placeholder="Address"
                  required
                ></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Height</label>
                <input
                  type="text"
                  class="form-control"
                  name="height"
                  placeholder="Height"
                  required
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Age</label>
                <input type="number" class="form-control" name="age" required />
              </div>
            </div>
            <div class="col-md-6">
  <div class="form-group">
    <label>Midwife/Nurse/Doctor</label>
    <select
      class="form-control"
      name="midwife_nurse_doctor"
      id="midwife_nurse_doctor"
      required
    >
      <option value="">Select Midwife/Nurse/Doctor</option>
      <?php foreach ($midwives as $midwife): ?>
        <option value="<?php echo htmlspecialchars($midwife['full_name']); ?>">
          <?php echo htmlspecialchars($midwife['full_name']); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
</div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Weight</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="weight" required />
                  <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Newly Added Fields -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Name of Husband</label>
                <input
                  type="text"
                  class="form-control"
                  name="husband_name"
                  placeholder="Name of Husband"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Plan to Deliver At</label>
                <input
                  type="text"
                  class="form-control"
                  name="plan_to_deliver_at"
                  placeholder="Plan to Deliver At"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>LMP</label>
                <input
                  type="date"
                  class="form-control"
                  name="lmp"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Civil Status</label>
                <select class="form-control" name="civil_status" placeholder="Civil Status" required>
                  <option >Single</option>
                  <option >Married</option>
                  <option >Divorced</option>
                  <option >Widowed</option>
                  <option >Cohabitation</option>
                </select>
              </div>


            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Religion</label>
                <input
                  type="text"
                  class="form-control"
                  name="religion"
                  placeholder="Religion"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Educational Level</label>
                <input
                  type="text"
                  class="form-control"
                  name="educ_level"
                  placeholder="Educational Level"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Occupation</label>
                <input
                  type="text"
                  class="form-control"
                  name="occupation"
                  placeholder="Occupation"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Monthly Income</label>
                <input
                  type="number"
                  class="form-control"
                  name="monthly_income"
                  placeholder="Monthly Income"
                />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Expected Delivery</label>
                <input type="date" class="form-control" name="expected_delivery" required/>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Blood Type</label>
                <input
                  type="text"
                  class="form-control"
                  name="blood_type"
                  placeholder="Blood Type"
                />
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- SEPARATE MODAL for editing -->
<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <span class="fa fa-hospital-user"></span> Edit Patient Information
        </h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./functions/update_patient.php" method="POST">
          <input type="hidden" name="patient_id" id="edit_patient_id" />

           <!--  -->
           <label>  ----------------------- Fill remarks if the patient does delivered but not in the clinic -----------------------</label>
          <div class="col-md-12">
    <div class="form-group text-center">
        <label for="remarks">Remarks</label>
        <input type="text" class="form-control" id="edit_remarks" name="remarks" placeholder="Input the reason" />
    </div>
</div>

                                    <label>  ----------------------- Fill remarks if the patient does delivered but not in the clinic -----------------------</label>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>First Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="first_name"
                  id="edit_first_name"
                  placeholder="First Name"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Middle Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="middle_name"
                  id="edit_middle_name"
                  placeholder="Middle Name"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Last Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="last_name"
                  id="edit_last_name"
                  placeholder="Last Name"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Contact</label>
                <input
                  type="text"
                  class="form-control"
                  name="contact"
                  id="edit_contact"
                  placeholder="Contact"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Birthdate</label>
                <input
                  type="date"
                  class="form-control"
                  name="birthdate"
                  id="edit_birthdate"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="edit_status" required>
                  <option value="">Select Status</option>
                  <option value="Pregnant">Pregnant</option>
                  <option value="Delivered">Delivered</option>
                  <option value="Delivered_other">Delivered(Not in Clinic)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Address</label>
                <textarea
                  class="form-control"
                  name="address"
                  id="edit_address"
                  placeholder="Address"
                  required
                ></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Height</label>
                <input
                  type="text"
                  class="form-control"
                  name="height"
                  id="edit_height"
                  placeholder="Height"
                  required
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Age</label>
                <input
                  type="number"
                  class="form-control"
                  name="age"
                  id="edit_age"
                  required
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Midwife/Nurse/Doctor</label>
                <select
                  class="form-control"
                  name="midwife_nurse_doctor"
                  id="edit_midwife_nurse_doctor"
                  required
                >
                  <option value="">Select Midwife/Nurse/Doctor</option>
                  <?php foreach ($midwives as $midwife): ?>
                    <option value="<?php echo htmlspecialchars($midwife['full_name']); ?>">
                      <?php echo htmlspecialchars($midwife['full_name']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Weight</label>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    name="weight"
                    id="edit_weight"
                    required
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Newly Added Fields -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Name of Husband</label>
                <input
                  type="text"
                  class="form-control"
                  name="husband_name"
                  id="edit_husband_name"
                  placeholder="Name of Husband"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Plan to Deliver At</label>
                <input
                  type="text"
                  class="form-control"
                  name="plan_to_deliver_at"
                  id="edit_plan_to_deliver_at"
                  placeholder="Plan to Deliver At"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>LMP</label>
                <input
                  type="date"
                  class="form-control"
                  name="lmp"
                  id="edit_lmp"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Civil Status</label>
                <input
                  type="text"
                  class="form-control"
                  name="civil_status"
                  id="edit_civil_status"
                  placeholder="Civil Status"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Religion</label>
                <input
                  type="text"
                  class="form-control"
                  name="religion"
                  id="edit_religion"
                  placeholder="Religion"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Educational Level</label>
                <input
                  type="text"
                  class="form-control"
                  name="educ_level"
                  id="edit_educ_level"
                  placeholder="Educational Level"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Occupation</label>
                <input
                  type="text"
                  class="form-control"
                  name="occupation"
                  id="edit_occupation"
                  placeholder="Occupation"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Monthly Income</label>
                <input
                  type="number"
                  class="form-control"
                  name="monthly_income"
                  id="edit_monthly_income"
                  placeholder="Monthly Income"
                />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Expected Delivery</label>
                <input
                  type="date"
                  class="form-control"
                  name="expected_delivery"
                  id="edit_expected_delivery"
                  required
                />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Blood Type</label>
                <input
                  type="text"
                  class="form-control"
                  name="blood_type"
                  id="edit_blood_type"
                  placeholder="Blood Type"
                />
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





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
    $('#uploadFiles').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var patientId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-body #uploadPatientId').val(patientId);
    });
</script>
<script>
$(document).ready(function() {
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var patientId = button.data('id'); // Extract the patient ID from the data-id attribute

        // Clear previous data from the modal
        $('#editModalForm input').val('');
        $('#editModalForm select').val('');
        $('#editModalForm textarea').val('');

        // Use AJAX to fetch patient data based on patient ID
        $.ajax({
            url: 'get_patient.php', // PHP script to fetch patient data
            method: 'POST',
            data: { patient_id: patientId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var data = response.data;
                    // Populate the modal form fields with the data
                    $('#edit_patient_id').val(data.patient_id);
                    $('#edit_first_name').val(data.first_name);
                    $('#edit_middle_name').val(data.middle_name);
                    $('#edit_last_name').val(data.last_name);
                    $('#edit_contact').val(data.contact);
                    $('#edit_birthdate').val(data.birthdate);
                    $('#edit_address').val(data.address);
                    $('#edit_age').val(data.age);
                    $('#edit_height').val(data.height);
                    $('#edit_midwife_nurse_doctor').val(data.midwife_nurse_doctor);
                    $('#edit_weight').val(data.weight);
                    $('#edit_prenatal_schedule').val(data.prenatal_schedule);
                    $('#edit_expected_delivery').val(data.expected_delivery);
                    $('#edit_status').val(data.status);
                    $('#edit_remarks').val(data.remarks);
                    $('#edit_husband_name').val(data.husband_name);
                    $('#edit_plan_to_deliver_at').val(data.plan_to_deliver_at);
                    $('#edit_lmp').val(data.lmp);
                    $('#edit_civil_status').val(data.civil_status);
                    $('#edit_religion').val(data.religion);
                    $('#edit_educ_level').val(data.educ_level);
                    $('#edit_occupation').val(data.occupation);
                    $('#edit_monthly_income').val(data.monthly_income);
                    $('#edit_blood_type').val(data.blood_type);
                } else {
                    alert(response.message); // Handle errors
                }
            },
            error: function() {
                alert('An error occurred while fetching the data.');
            }
        });
    });
});
</script>




    <script>
      $(document).ready(function () {
        $.ajax({
          url: "fetch_patients.php",
          method: "GET",
          dataType: "json",
          success: function (data) {
            var tbody = $("#patient-data");
            $.each(data, function (index, patient) {
              var fullName =
                patient.first_name +
                " " +
                (patient.middle_name ? patient.middle_name + " " : "") +
                patient.last_name;
              var row = `
                    <tr>
                        <td>${patient.patient_id}</td>
                        <td>${fullName}</td>
                        <td>${patient.contact}</td>
                        <td>${patient.email}</td>
                        <td>${patient.address}</td>
                        <td>${patient.birthdate}</td>
                        <td>${patient.age}</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#edit">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                `;
              tbody.append(row);
            });

            // Initialize DataTables
            $("#example1").DataTable();
          },
        });
      });

      document.addEventListener('DOMContentLoaded', function () {
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var patientId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-body input#patient_id').val(patientId);
    });
});

    </script>
    <script>
        $(document).ready(function() {
            // Check if the success message is present in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('message') && urlParams.get('message') === 'success') {
                // Show success message
                alert("Record successfully added!");

                // Remove the message parameter from the URL to avoid repeated alerts
                const newUrl = window.location.href.split('?')[0];
                window.history.replaceState(null, null, newUrl);

                // Refresh the page
                location.reload();
            }
        });
    </script>


<!-- TOOLTIP -->
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

  </body>
</html>
