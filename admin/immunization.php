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
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">
                  <span class="fa fa-syringe"></span> Immunized Records
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Immunization</li>
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

              <!-- Button to open Add Immunization Type modal -->
              <button class="btn btn-sm elevation-2" data-toggle="modal" data-target="#addImmunizationModal" style="float: left; margin-top: 20px; margin-left: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-plus"></i> Add Immunization Type
</button>


              <!-- <a class="btn btn-sm elevation-2" href="javascript:history.back()" style="float: left; margin-top: 20px; margin-left: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-arrow-left"></i> Go Back
</a> -->

            </div>
          </div>
        </div>
        
        <?php
include 'functions/db_connection.php';

$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

$sql = "SELECT * FROM immunizations";
if ($month && $year) {
    $sql .= " WHERE DATE_FORMAT(date_of_immunization, '%M') = ? AND DATE_FORMAT(date_of_immunization, '%Y') = ?";
} elseif ($month) {
    $sql .= " WHERE DATE_FORMAT(date_of_immunization, '%M') = ?";
} elseif ($year) {
    $sql .= " WHERE DATE_FORMAT(date_of_immunization, '%Y') = ?";
}

$stmt = $conn->prepare($sql);
if ($month && $year) {
    $stmt->bind_param('ss', $month, $year);
} elseif ($month) {
    $stmt->bind_param('s', $month);
} elseif ($year) {
    $stmt->bind_param('s', $year);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info elevation-2">
            <br />
            <div class="col-md-12">
                <!-- Search Form and Buttons -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-9 text-right">
                        <button id="printButton" class="btn btn-primary">Print</button>
                        <button id="downloadButton" class="btn btn-secondary">Download</button>
                    </div>
                </div>
                
                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Child Name</th>
                                <th>Age</th>
                                <th>Immunization Type</th>
                                <th>Date of Immunization</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr data-id="<?php echo $row['id']; ?>">
                                        <td><?php echo htmlspecialchars($row['child_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                                        <td><?php echo htmlspecialchars($row['immunization_type']); ?></td>
                                        <td><?php echo htmlspecialchars($row['date_of_immunization']); ?></td>
                                        <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#edit" data-toggle='tooltip' title='Edit'>
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete" data-id="<?php echo $row['id']; ?>" data-toggle='tooltip' title='Delete'>
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No records found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div> <!-- End of table-responsive -->
            </div>
        </div>
    </div>
</section>




      </div>
    </div>

    <!-- Delete modal -->
    <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="../asset/img/sent.png" alt="" width="50" height="46" />
                <h3>Are you sure you want to delete this Immunized Record?</h3>
                <input type="hidden" id="delete-record-id">
                <div class="m-t-20">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button type="button" class="btn btn-danger confirm-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>


   <!-- Edit Modal -->
   <div id="edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    <input type="hidden" id="edit-record-id">
                    <div class="form-group">
                        <label for="edit-child-name">Child Name</label>
                        <input type="text" id="edit-child-name" class="form-control" placeholder="child name">
                    </div>
                    <div class="form-group">
                        <label for="edit-age">Age</label>
                        <input type="number" id="edit-age" class="form-control" placeholder="age">
                    </div>
                    <div class="form-group">
                        <label for="edit-immunization-type">Immunization Type</label>
                        <select id="edit-immunization-type" class="form-control">
                            <option>Hepa A</option>
                            <option>Hepa B</option>
                            <option>Influenza</option>
                            <option>Measles</option>
                            <option>Inactivated Poliovirus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-date-of-immunization">Date Of Immunization</label>
                        <input type="date" id="edit-date-of-immunization" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="edit-remarks">Remarks</label>
                        <input type="text" id="edit-remarks" class="form-control" placeholder="remarks">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="save-changes-btn" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for adding and managing immunization types -->
<div id="addImmunizationModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Immunization Types</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addImmunizationForm">
          <div class="form-group">
            <label for="immunizationType">Add Immunization Type</label>
            <input type="text" class="form-control" id="immunizationType" name="immunization_type" required>
            <button type="submit" class="btn btn-primary mt-2">Add</button>
          </div>
        </form>

        <hr>

        <h5>Existing Immunization Types</h5>
        <ul class="list-group">
          <?php
          // Database connection
          $conn = new mysqli('localhost', 'root', '', 'mrm');

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Fetch immunization types
          $sql = "SELECT id, immunization_type FROM immun_type";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                  echo htmlspecialchars($row['immunization_type']);
                  echo '<button class="btn btn-danger btn-sm delete-immun-type" data-id="' . $row['id'] . '">Delete</button>';
                  echo '</li>';
              }
          } else {
              echo '<li class="list-group-item">No immunization types available</li>';
          }

          // Close connection
          $conn->close();
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal for adding immunized -->
<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-body text-center">
        <form action="add_immunization.php" method="post">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card-header">
                  <span class="fa fa-baby"> Child Information</span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Child Name</label>
                      <input
                        type="text"
                        class="form-control"
                        name="child_name" 
                        placeholder="Child Name"
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
                        placeholder="Age"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
    <div class="form-group">
        <label>Immunization Type</label>
        <select class="form-control" name="immunization_type" required>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'mrm');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch immunization types
            $sql = "SELECT immunization_type FROM immun_type";
            $result = $conn->query($sql);

            // Check if any results were returned
            if ($result->num_rows > 0) {
                // Output each immunization type as an option
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . htmlspecialchars($row['immunization_type']) . "\">" . htmlspecialchars($row['immunization_type']) . "</option>";
                }
            } else {
                echo "<option value=\"\">No immunization types available</option>";
            }

            // Close connection
            $conn->close();
            ?>
        </select>
    </div>
</div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date Of Immunization</label>
                      <input type="date" class="form-control" name="date_of_immunization" required /> <!-- Add name attribute -->
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Remarks</label>
                      <input
                        type="text"
                        class="form-control"
                        name="remarks" 
                        placeholder="Remarks"
                      />
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
    <script src="../asset/jquery/jquery.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/adminlte.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
    <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<!-- Script to handle button click and form submission -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Handle the delete ion of existing immunization type -->
<script>
  // Handle delete button click
document.querySelectorAll('.delete-immun-type').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');

        if (confirm('Are you sure you want to delete this immunization type?')) {
            // Send AJAX request to delete the immunization type
            fetch('delete_immunization_type.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'immunization_type_id=' + encodeURIComponent(id)
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'success') {
                    // Reload the page to see the changes
                    location.reload();
                } else {
                    alert('Failed to delete the immunization type: ' + data);
                }
            });
        }
    });
});

// Handle form submission for adding a new immunization type
document.getElementById('addImmunizationForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Get the input value
    const immunizationType = document.getElementById('immunizationType').value;

    // Send AJAX request to add the immunization type
    fetch('add_immunization_type.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'immunization_type=' + encodeURIComponent(immunizationType)
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success') {
            // Reload the page to see the new immunization type
            location.reload();
        } else {
            alert('Failed to add the immunization type.');
        }
    });
});

</script>

<script>
$(document).ready(function() {
    $('#addImmunizationForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get the form data
        var formData = $(this).serialize();

        // Send an AJAX request to add_immunization.php
        $.ajax({
            url: 'add_immunization.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#addImmunizationModal').modal('hide'); // Hide the modal
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while adding the immunization type.');
            }
        });
    });
});

</script>
<!-- Script to handle form submission and update select options
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#addImmunizationForm').on('submit', function(e) {
      e.preventDefault(); // Prevent the form from submitting the traditional way

      // Get the new immunization type
      var newImmunizationType = $('#immunizationType').val().trim();

      if (newImmunizationType) {
        // Append new option to the select element
        $('select[name="immunization_type"]').append(
          $('<option>', {
            value: newImmunizationType,
            text: newImmunizationType
          })
        );

        // Hide the modal
        $('#addImmunizationModal').modal('hide');

        // Clear the input field
        $('#immunizationType').val('');
      } else {
        alert('Please enter a valid immunization type.');
      }
    });
  });
</script> -->



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
      $(function () {
        $("#example1").DataTable();
      });
    </script>

    <!-- For fetching  data in the edit modal -->
    <script>
    
    $(document).ready(function () {
    // Event handler for the edit button
    $('#example1').on('click', '.btn-success', function (e) {
        e.preventDefault();

        // Get data from the clicked row
        var $row = $(this).closest('tr');
        var recordId = $row.data('id'); // Assuming you have added data-id attribute to the row
        var childName = $row.find('td').eq(0).text();
        var age = $row.find('td').eq(1).text();
        var immunizationType = $row.find('td').eq(2).text();
        var dateOfImmunization = $row.find('td').eq(3).text();
        var remarks = $row.find('td').eq(4).text();
        
        // Populate the modal fields with the data
        $('#edit-record-id').val(recordId);
        $('#edit-child-name').val(childName);
        $('#edit-age').val(age);
        $('#edit-immunization-type').val(immunizationType);
        $('#edit-date-of-immunization').val(dateOfImmunization);
        $('#edit-remarks').val(remarks);

        // Show the modal
        $('#edit').modal('show');
    });

    // Form submission handler with AJAX to save changes
    $('#save-changes-btn').on('click', function (e) {
        e.preventDefault();

        var recordId = $('#edit-record-id').val();
        var childName = $('#edit-child-name').val();
        var age = $('#edit-age').val();
        var immunizationType = $('#edit-immunization-type').val();
        var dateOfImmunization = $('#edit-date-of-immunization').val();
        var remarks = $('#edit-remarks').val();

        $.ajax({
            url: 'update_record.php',
            method: 'POST',
            data: {
                id: recordId,
                child_name: childName,
                age: age,
                immunization_type: immunizationType,
                date_of_immunization: dateOfImmunization,
                remarks: remarks
            },
            success: function (response) {
                // Show success message
                alert(response);
                // Close the modal
                $('#edit').modal('hide');
                // Reload the page to reflect changes
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
});


</script>



<script>
$(document).ready(function() {
    $('#delete').on('show.bs.modal', function(e) {
        var recordId = $(e.relatedTarget).data('id');
        $('#delete-record-id').val(recordId);
    });

    $('.confirm-delete').on('click', function() {
        var recordId = $('#delete-record-id').val();

        $.ajax({
            url: 'archive_immun_record.php',
            type: 'POST',
            data: { id: recordId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Record has been moved to the archive.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        location.reload(); // Refresh the page after clicking OK
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'AJAX Error!',
                    text: 'An error occurred while making the AJAX request: ' + status + ', ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
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
        var searchInput = document.getElementById('searchInput');

        // Hide the buttons and search input before printing
        printButton.style.display = 'none';
        downloadButton.style.display = 'none';
        searchInput.style.display = 'none';

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
                .print-header {
                    text-align: center;
                    margin-bottom: 20px;
                }
            </style>
        `);
        printWindow.document.write('</head><body>');
        
        // Add a header before the table
        printWindow.document.write('<div class="print-header"><h1>Immunized Records</h1></div>'); // Customize your header title

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



    // Download button functionality (this example assumes the download button generates a CSV file)
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
