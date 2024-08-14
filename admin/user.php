

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

          </li>
        </ul>
      </nav>
      </li>
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
                  <li class="nav-item">
                    <a href="archive_midwife.php" class="nav-link">
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
                  <li class="nav-item">
                    <a href="user.php" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Users</p>
                    </a>
                  </li>
                  <li class="nav-item">
    <a href="backup.php" class="nav-link">
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
                  <span class="fa fa-hospital-user"></span> Users list
                </h1>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Maintenance Users</li>
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
                <table id="example1" class="table table-bordered table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Contact</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Include database connection
                    include('functions/db_connection.php'); // Ensure this path is correct

                    // Fetch user data
                    $query = "SELECT * FROM user";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_type']) . "</td>";
                            echo "<td><a href='delete_user.php?id=" . htmlspecialchars($row['user_id']) . "' class='btn btn-danger' onclick='return confirmDelete()'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }

                    // Close the connection
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
</script>



    
<!-- Edit form -->
<div id="edit" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="update_midwife.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-hospital-user">Edit Midwife Information</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Midwife ID</label>
                                            <input type="text" class="form-control" name="midwife_id" id="midwife_id" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name" id="middle_name" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="text" class="form-control" name="contact" id="contact" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" id="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" class="form-control" name="birthdate" id="birthdate" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" class="form-control" name="age" id="age" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    <!-- Adding User form -->
<div id="add" class="modal animated rubberBand delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="save_user.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <span class="fa fa-hospital-user">Add New User</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>UserName:</label>
                                            <input type="text" class="form-control" name="username" placeholder="First Name" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="text" class="form-control" name="contact" placeholder="Contact" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="userType">User Type</label>
        <select class="form-control" id="userType" name="userType">
            <option value="staff">Staff</option>
            <option value="administrator">Administrator</option>
        </select>
    </div>
</div>

                                </div>
                            </div>
                        </div>
                    </div>
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
    <script>
      $(document).ready(function() {
    $('#edit').on('show.bs.modal', function(e) {
        var midwifeId = $(e.relatedTarget).data('id');
        
        $.ajax({
            url: 'get_midwife_data.php',
            type: 'GET',
            data: { id: midwifeId },
            success: function(response) {
                console.log('Response:', response); // Debugging line
                var midwife = JSON.parse(response);
                if (midwife.error) {
                    alert(midwife.error);
                } else {
                    $('#midwife_id').val(midwife.midwife_id);
                    $('#first_name').val(midwife.first_name);
                    $('#middle_name').val(midwife.middle_name);
                    $('#last_name').val(midwife.last_name);
                    $('#contact').val(midwife.contact);
                    $('#email').val(midwife.email);
                    $('#address').val(midwife.address);
                    $('#birthdate').val(midwife.birthdate);
                    $('#age').val(midwife.age);
                    $('#status').val(midwife.status);
                }
            },
            error: function() {
                alert('Error fetching data.');
            }
        });
    });
});

</script>





    
  </body>
</html>
