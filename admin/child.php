<?php
// Assuming you have started the session and have user information in session variables
session_start();

// Fetch the user_type from the session
$user_type = $_SESSION['user_type'] ?? '';

// You can also fetch it directly from the database if needed
// Example: $user_type = fetchUserTypeFromDatabase($user_id);
?>
<?php

// Include the script that counts records
include('count_records.php'); // Adjust the path if necessary
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
      <a href="vaccinated-report.php" class="nav-link">
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
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">
                  <span class="fa fa-baby"></span> Child Records
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Child</li>
                </ol>
              </div>
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

            </div>
          </div>
        </div>
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

// Initialize variables
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

// Prepare SQL query based on month and year filters
if (!empty($month) && !empty($year)) {
    // Convert month name to month number
    $monthNum = date('m', strtotime($month));
    $sql = "SELECT * FROM child WHERE YEAR(birth_date) = ? AND MONTH(birth_date) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $year, $monthNum);
} elseif (!empty($year)) {
    $sql = "SELECT * FROM child WHERE YEAR(birth_date) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $year);
} else {
    $sql = "SELECT * FROM child";
    $stmt = $conn->prepare($sql);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Start output buffering
ob_start();
?>
<!-- Table -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-info elevation-2">
      <br />
      <div class="col-md-12">
        <!-- Buttons for Print and Download -->
        <div class="row mb-3">
          <div class="col-md-2 ml-auto">
            <button id="printButton" class="btn btn-primary">Print</button>
            <button id="downloadButton" class="btn btn-secondary">Download</button>
          </div>
        </div>

        <!-- Responsive Table -->
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Mother Name</th>
                <th>Child Name</th>
                <th>Birthdate</th>
                <th>Weight</th>
                <th>Height</th>
                <th>New Born Screening (Remarks)</th> <!-- Added column for Remarks -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['mother_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['child_last_name']) . ' ' . htmlspecialchars($row['child_first_name']); ?></td>
                    <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($row['birth_date']))); ?></td>
                    <td><?php echo htmlspecialchars($row['weight']); ?></td>
                    <td><?php echo htmlspecialchars($row['height']); ?></td>
                    <td><?php echo htmlspecialchars($row['remarks']); ?></td> <!-- Display Remarks -->
                    <td class="text-right">
                      <a class="btn btn-sm btn-success btn-edit" href="#" data-toggle="modal" data-target="#edit" data-id="<?php echo $row['id']; ?>" data-toggle='tooltip' title='Edit'>
                        <i class="fa fa-pen"></i>
                      </a>
                      <a class="btn btn-sm btn-danger btn-delete" href="#" data-toggle="modal" data-target="#delete" data-id="<?php echo $row['id']; ?>" data-toggle='tooltip' title='Delete'>
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php }
              } else { ?>
                <tr><td colspan="8" class="text-center">No records found</td></tr> <!-- Adjusted colspan -->
              <?php } ?>
            </tbody>
          </table>
        </div> <!-- End of table-responsive -->
      </div>
    </div>
  </div>
</section>


<?php
$stmt->close();
$conn->close();
?>





<!-- Delete Modal -->
<div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="../asset/img/sent.png" alt="" width="50" height="46" />
        <h3>Are you sure you want to delete this Child Record?</h3>
        <div class="m-t-20">
          <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
          <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Form for Editing Child -->
<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center">
        <form id="editChildForm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card-header">
                  <span class="fa fa-baby"> Child Information</span>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" class="form-control" name="id" id="editChildId" readonly />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mother's Name</label>
                      <input type="text" class="form-control" id="editMotherName" name="mother_name" placeholder="Mother's Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child Last Name</label>
                      <input type="text" class="form-control" id="editChildLastName" name="child_last_name" placeholder="Last Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child First Name</label>
                      <input type="text" class="form-control" id="editChildFirstName" name="child_first_name" placeholder="First Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child Middle Name</label>
                      <input type="text" class="form-control" id="editChildMiddleName" name="child_middle_name" placeholder="Middle Name" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Birth Date</label>
                      <input type="date" class="form-control" id="editBirthDate" name="birth_date" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Weight</label>
                      <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" id="editWeight" name="weight" />
                        <div class="input-group-append">
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Height</label>
                      <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" id="editHeight" name="height" />
                        <div class="input-group-append">
                          <span class="input-group-text">cm</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Remarks</label> <!-- Added Remarks input -->
                      <textarea class="form-control" id="editRemarks" name="remarks" placeholder="Enter any remarks"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Adding Child Form -->
<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center">
        <form method="POST" action="add_child.php">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card-header">
                  <span class="fa fa-baby"> Add Child Information</span>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mother's Name</label>
                      <input type="text" class="form-control" name="mother_name" placeholder="Mother's Name" required />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child Last Name</label>
                      <input type="text" class="form-control" name="child_last_name" placeholder="Last Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child First Name</label>
                      <input type="text" class="form-control" name="child_first_name" placeholder="First Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child Middle Name</label>
                      <input type="text" class="form-control" name="child_middle_name" placeholder="Middle Name" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Birth Date</label>
                      <input type="date" class="form-control" name="birth_date" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Weight</label>
                      <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" name="weight" required />
                        <div class="input-group-append">
                          <span class="input-group-text">kg</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Height</label>
                      <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" name="height" required />
                        <div class="input-group-append">
                          <span class="input-group-text">cm</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Remarks</label> <!-- Added Remarks input -->
                      <textarea class="form-control" name="remarks" placeholder="Enter any remarks"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/adminlte.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- Add jQuery for handling the AJAX request -->


<!-- JavaScript for handling the delete action -->
<script>
$(document).ready(function() {
    var recordId; // Variable to store the ID of the record to be deleted

    // Open the delete modal and store the record ID
    $('.btn-delete').on('click', function() {
        recordId = $(this).data('id');
    });

    // Handle the confirm delete button click
    $('#confirmDelete').on('click', function() {
        $.ajax({
            url: 'child_to_archive.php',
            type: 'POST',
            data: { id: recordId },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Record was moved to archive successfully
                    location.reload(); // Refresh the page
                } else {
                    // Handle error
                    alert('Error: ' + data.error);
                }
            },
            error: function() {
                alert('An error occurred while processing your request.');
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    var recordId; // Variable to store the ID of the record to be deleted

    // Open the delete modal and store the record ID
    $('.btn-delete').on('click', function() {
        recordId = $(this).data('id');
    });

    // Handle the confirm delete button click
    $('#confirmDelete').on('click', function() {
        $.ajax({
            url: 'child_to_archive.php',
            type: 'POST',
            data: { id: recordId },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Display success message
                    alert('Record successfully archived.');
                    // Refresh the page
                    location.reload();
                } else {
                    // Handle error
                    alert('Error: ' + data.error);
                }
            },
            error: function() {
                alert('An error occurred while processing your request.');
            }
        });
    });
});
</script>

    <script>
      $(function () {
        $("#example1").DataTable();
      });
    </script>
    <script>
  $(document).ready(function() {
    // Show edit modal with data
    $('.btn-success').on('click', function() {
      var row = $(this).closest('tr');
      var id = $(this).attr('data-id');
      $('#editChildForm').find('input[name="id"]').val(id);

      // Fetch child data
      $.ajax({
        url: 'get_child.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
          var data = JSON.parse(response);
          $('#editMotherName').val(data.mother_name);
          $('#editChildLastName').val(data.child_last_name);
          $('#editChildFirstName').val(data.child_first_name);
          $('#editChildMiddleName').val(data.child_middle_name);
          $('#editBirthDate').val(data.birth_date);
          $('#editWeight').val(data.weight);
          $('#editHeight').val(data.height);
          $('#editRemarks').val(data.remarks);
        }
      });
    });

    // Handle form submission
    $('#editChildForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: 'update_child.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          alert(response);
          location.reload(); // Reload page to see changes
        }
      });
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Print button functionality
    document.getElementById('printButton').addEventListener('click', function () {
        var printButton = document.getElementById('printButton');
        var downloadButton = document.getElementById('downloadButton');

        // Hide the buttons before printing
        printButton.style.display = 'none';
        downloadButton.style.display = 'none';

        // Open a new window for printing
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print</title>');
        
        // Add necessary styles, including table borders
        printWindow.document.write(`
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, th, td {
                    border: 1px solid black;
                }
                th, td {
                    padding: 8px;
                    text-align: left;
                }
            </style>
        `);
        printWindow.document.write('</head><body>');
        
        // Add the header before the table
        printWindow.document.write('<h1 style="text-align: center;">Child Records</h1>'); // Customize your header title

        // Write the content of the table to the new window
        printWindow.document.write(document.querySelector('table').outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();

        // Restore the buttons after printing
        printButton.style.display = '';
        downloadButton.style.display = '';
    });



    // Download button functionality
    document.getElementById('downloadButton').addEventListener('click', function () {
        var table = document.querySelector('table');
        var csv = [];
        
        // Extract table header
        var headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText);
        csv.push(headers.join(','));
        
        // Extract table rows
        Array.from(table.querySelectorAll('tbody tr')).forEach(row => {
            var cells = Array.from(row.querySelectorAll('td')).map(td => td.innerText);
            csv.push(cells.join(','));
        });

        // Create CSV file and trigger download
        var csvContent = 'data:text/csv;charset=utf-8,' + encodeURI(csv.join('\n'));
        var link = document.createElement('a');
        link.setAttribute('href', csvContent);
        link.setAttribute('download', 'data.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});

</script>
  </body>
</html>
