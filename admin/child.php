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
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
        <a href="../index.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>
      <?php
// Assuming you have started the session and have user information in session variables
session_start();

// Fetch the user_type from the session
$user_type = $_SESSION['user_type'] ?? '';

// You can also fetch it directly from the database if needed
// Example: $user_type = fetchUserTypeFromDatabase($user_id);
?>
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

            <li class="nav-item">
              <a href="archive_midwives.php" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>Midwives</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="archive_child.php" class="nav-link">
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

// Fetch data from the child table
$sql = "SELECT * FROM child";
$result = $conn->query($sql);

// Start output buffering
ob_start();
?>

<!-- Table -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-info elevation-2">
      <br />
      <div class="col-md-12">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th> <!-- Added column for ID -->
              <th>Mother Name</th>
              <th>Child Name</th>
              <th>Gender</th>
              <th>Birthdate</th>
              <th>Weight</th>
              <th>Height</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo htmlspecialchars($row['id']); ?></td> <!-- Display ID -->
                  <td><?php echo htmlspecialchars($row['mother_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['child_last_name']) . ' ' . htmlspecialchars($row['child_first_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['gender']); ?></td>
                  <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($row['birth_date']))); ?></td>
                  <td><?php echo htmlspecialchars($row['weight']); ?></td>
                  <td><?php echo htmlspecialchars($row['height']); ?></td>
                  <td class="text-right">
                    <a class="btn btn-sm btn-success btn-edit" href="#" data-toggle="modal" data-target="#edit" data-id="<?php echo $row['id']; ?>">
                      <i class="fa fa-pen"></i>
                    </a>
                    <a class="btn btn-sm btn-danger btn-delete" href="#" data-toggle="modal" data-target="#delete" data-id="<?php echo $row['id']; ?>">
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
      </div>
    </div>
  </div>
</section>


<?php
// Close connection
$conn->close();
// End output buffering and flush
echo ob_get_clean();
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

<!-- form for editing child -->
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
                      <input
                        type="text"
                        class="form-control"
                        id="editMotherName"
                        name="mother_name"
                        placeholder="Mother's Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child Last Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="editChildLastName"
                        name="child_last_name"
                        placeholder="Last Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child First Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="editChildFirstName"
                        name="child_first_name"
                        placeholder="First Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child Middle Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="editChildMiddleName"
                        name="child_middle_name"
                        placeholder="Middle Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" id="editGender" name="gender">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
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
                      <input type="text" class="form-control" name="child_last_name" placeholder="Last Name" required />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Child First Name</label>
                      <input type="text" class="form-control" name="child_first_name" placeholder="First Name" required />
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
                      <label>Gender</label>
                      <select class="form-control" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
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
          $('#editGender').val(data.gender);
          $('#editBirthDate').val(data.birth_date);
          $('#editWeight').val(data.weight);
          $('#editHeight').val(data.height);
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

  </body>
</html>
