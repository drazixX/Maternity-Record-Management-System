

<!-- Rest of your patient.php content -->

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
        width: 100%; /* Adjust if needed */
        margin-bottom: 10px; /* Space between inputs */
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
                  <li class="breadcrumb-item active">Archive Patients</li>
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
        <section class="content">
    <div class="container-fluid">
        <div class="card card-info elevation-2">
            <br />
            <div class="col-md-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Full Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Date Checked In</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
              archive_patient";

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
        echo "<a class='btn btn-sm btn-primary' href='#' data-toggle='modal' data-target='#restore' data-id='" . htmlspecialchars($row['patient_id']) . "'><i class='fa fa-undo'></i> Restore</a>";
        echo "<a class='btn btn-sm btn-danger' href='#' data-toggle='modal' data-target='#delete' data-id='" . htmlspecialchars($row['patient_id']) . "'><i class='fa fa-trash'></i></a>";

        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}

// Close the database connection
$mysqli->close();
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div id="restore" class="modal animated rubberBand restore-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="../asset/img/restore.png" alt="" width="50" height="46" />
                <h3>Are you sure you want to restore this Patient?</h3>
                <div class="m-t-20">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <form action="restore_from_archive.php" method="POST" style="display: inline;">
                        <input type="hidden" name="patient_id" id="patient_id_restore" value="">
                        <button type="submit" class="btn btn-primary restore-btn">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Edit Modal -->
<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <span class="fa fa-hospital-user"></span> Edit Patients Information
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
      <form action="functions/update_patient.php" method="POST">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input
                  type="text"
                  class="form-control"
                  id="patient_id"
                  name="patient_id"
                  placeholder="PNT-123"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="first_name"
                  name="first_name"
                  placeholder="First Name"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="middle_name"
                  name="middle_name"
                  placeholder="Middle Name"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="last_name"
                  name="last_name"
                  placeholder="Last Name"
                  required
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contact">Contact</label>
                <input
                  type="text"
                  class="form-control"
                  id="contact"
                  name="contact"
                  placeholder="Contact"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input
                  type="date"
                  class="form-control"
                  id="birthdate"
                  name="birthdate"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="address">Address</label>
                <textarea
                  class="form-control"
                  id="address"
                  name="address"
                  placeholder="Address"
                ></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="age">Age</label>
                <input
                  type="number"
                  class="form-control"
                  id="age"
                  name="age"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="midwife_nurse_doctor">Midwife/Nurse/Doctor</label>
                <input
                  type="text"
                  class="form-control"
                  id="midwife_nurse_doctor"
                  name="midwife_nurse_doctor"
                  placeholder="Midwife/Nurse/Doctor"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="weight">Weight</label>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    id="weight"
                    name="weight"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="size_of_tummy">Size of Tummy</label>
                <input
                  type="number"
                  class="form-control"
                  id="size_of_tummy"
                  name="size_of_tummy"
                  placeholder="Size of Tummy"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="expected_delivery">Expected Delivery</label>
                <input
                  type="date"
                  class="form-control"
                  id="expected_delivery"
                  name="expected_delivery"
                  required
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="status">Status</label>
                <select
                  class="form-control"
                  id="status"
                  name="status"
                  required
                >
                  <option value="">Select Status</option>
                  <option value="Pregnant">Pregnant</option>
                  <option value="Delivered">Delivered</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center">
                <label>Vitals</label>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="bp">BP</label>
                      <input
                        type="text"
                        class="form-control"
                        id="bp"
                        name="bp"
                        placeholder="BP"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="pr">PR</label>
                      <input
                        type="text"
                        class="form-control"
                        id="pr"
                        name="pr"
                        placeholder="PR"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="rr">RR</label>
                      <input
                        type="text"
                        class="form-control"
                        id="rr"
                        name="rr"
                        placeholder="RR"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="fh">FH</label>
                      <input
                        type="text"
                        class="form-control"
                        id="fh"
                        name="fh"
                        placeholder="FH"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="fht">FHT</label>
                      <input
                        type="text"
                        class="form-control"
                        id="fht"
                        name="fht"
                        placeholder="FHT"
                      />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="aog">AOG</label>
                      <input
                        type="text"
                        class="form-control"
                        id="aog"
                        name="aog"
                        placeholder="AOG"
                      />
                    </div>
                  </div>
                </div>
              </div>
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
        </form>
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Contact</label>
                    <input
                      type="text"
                      class="form-control"
                      name="contact"
                      placeholder="Contact"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Birthdate</label>
                    <input type="date" class="form-control" name="birthdate" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address</label>
                    <textarea
                      class="form-control"
                      name="address"
                      placeholder="Address"
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
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Age</label>
                    <input type="number" class="form-control" name="age" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Midwife/Nurse/Doctor</label>
                    <input
                      type="text"
                      class="form-control"
                      name="midwife_nurse_doctor"
                      placeholder="Midwife/Nurse/Doctor"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Weight</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="weight" />
                      <div class="input-group-append">
                        <span class="input-group-text">kg</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Size of Tummy</label>
                    <input
                      type="number"
                      class="form-control"
                      name="size_of_tummy"
                      placeholder="Size of Tummy"
                    />
                  </div>
                </div>    
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Expected Delivery</label>
                              <input type="date" class="form-control" name="expected_delivery" required/>
                          </div>
                      </div>
                      <div class="col-md-3">
                      <div class="form-group">
  <label>Status</label>
  <select class="form-control" name="status" required>
    <option value="">Select Status</option>
    <option value="Pregnant">Pregnant</option>
    <option value="Delivered">Delivered</option>
  </select>
</div>

                </div>
                <div class="col-md-12">
                  <div class="form-group text-center">
                    <label>Vitals</label>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="bp">BP</label>
                          <input
                            type="text"
                            class="form-control"
                            id="bp"
                            name="bp"
                            placeholder="BP"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="pr">PR</label>
                          <input
                            type="text"
                            class="form-control"
                            id="pr"
                            name="pr"
                            placeholder="PR"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="rr">RR</label>
                          <input
                            type="text"
                            class="form-control"
                            id="rr"
                            name="rr"
                            placeholder="RR"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="fh">FH</label>
                          <input
                            type="text"
                            class="form-control"
                            id="fh"
                            name="fh"
                            placeholder="FH"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="fht">FHT</label>
                          <input
                            type="text"
                            class="form-control"
                            id="fht"
                            name="fht"
                            placeholder="FHT"
                          />
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="aog">AOG</label>
                          <input
                            type="text"
                            class="form-control"
                            id="aog"
                            name="aog"
                            placeholder="AOG"
                          />
                        </div>
                      </div>
                    </div>
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

    <script>
      $('#restore').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var patientId = button.data('id');
    var modal = $(this);
    modal.find('#patient_id_restore').val(patientId);
});
      $(function () {
        $("#example1").DataTable();
      });
    </script>
    <script>
$(document).ready(function() {
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var patientId = button.data('id'); // Extract info from data-* attributes
        
        // Make an AJAX request to fetch patient data
        $.ajax({
            url: 'get_patient.php', // Create this file to return patient data
            type: 'POST',
            data: { patient_id: patientId },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    // Populate the form fields with the fetched data
                    $('#patient_id').val(response.data.patient_id);
                    $('#first_name').val(response.data.first_name);
                    $('#middle_name').val(response.data.middle_name);
                    $('#last_name').val(response.data.last_name);
                    $('#contact').val(response.data.contact);
                    $('#birthdate').val(response.data.birthdate);
                    $('#address').val(response.data.address);
                    $('#age').val(response.data.age);
                    $('#midwife_nurse_doctor').val(response.data.midwife_nurse_doctor);
                    $('#weight').val(response.data.weight);
                    $('#size_of_tummy').val(response.data.size_of_tummy);
                    $('#bp').val(response.data.bp);
                    $('#pr').val(response.data.pr);
                    $('#rr').val(response.data.rr);
                    $('#fh').val(response.data.fh);
                    $('#fht').val(response.data.fht);
                    $('#aog').val(response.data.aog);
                    $('#expected_delivery').val(response.data.expected_delivery);
                    $('#status').val(response.data.status);
                    $('#height').val(response.data.height);
                    $('#remarks').val(response.data.remarks);
                    $('#prenatal_schedule').val(response.data.prenatal_schedule);
                } else {
                    // Handle errors
                    alert('Error fetching patient data');
                }
            },
            error: function() {
                alert('Failed to fetch patient data');
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
    
  </body>
</html>
