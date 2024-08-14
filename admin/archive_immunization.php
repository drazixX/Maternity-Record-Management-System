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
              <a class="btn btn-sm elevation-2" href="javascript:history.back()" style="float: left; margin-top: 20px; margin-left: 10px; background-color: rgba(131, 219, 214);">
    <i class="fa fa-arrow-left"></i> Go Back
</a>

            </div>
          </div>
        </div>
        


        <section class="content">
    <div class="container-fluid">
        <div class="card card-info elevation-2">
            <br />
            <div class="col-md-12">
                <table id="example1" class="table-responsive table-bordered table">
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
    <?php
    include 'archive_immunizations.php'; // Fetch data from archive_immunizations table

    if ($result->num_rows > 0):
        while($row = $result->fetch_assoc()): ?>
            <tr data-id="<?php echo $row['id']; ?>">
                <td><?php echo htmlspecialchars($row['child_name']); ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo htmlspecialchars($row['immunization_type']); ?></td>
                <td><?php echo htmlspecialchars($row['date_of_immunization']); ?></td>
                <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                <td class="text-right">
                <a class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#restore" data-id="<?php echo $row['id']; ?>" data-toggle='tooltip' title='Restore'>
    <i class="fa fa-arrow-left"></i>
</a>

                    <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete" data-id="<?php echo $row['id']; ?>" data-toggle='tooltip' title='Delete'>
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No records found</td>
        </tr>
    <?php endif; ?>
</tbody>
                </table>
            </div>
        </div>
    </div>
</section>




      </div>
    </div>

    
    <!-- Restore modal -->
    <div id="restore" class="modal animated rubberBand restore-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="../asset/img/restore.png" alt="" width="50" height="46" />
                <h3>Are you sure you want to restore this Immunized Record?</h3>
                <input type="hidden" id="restore-record-id" value="">
                <div class="m-t-20">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button type="button" class="btn btn-warning confirm-restore">Restore</button>
                </div>
            </div>
        </div>
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
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->


<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


    <script>
      $(function () {
        $("#example1").DataTable();
      });
  </script>


<script>$(document).ready(function() {
    $('#restore').on('show.bs.modal', function(e) {
        var recordId = $(e.relatedTarget).data('id');
        $('#restore-record-id').val(recordId);
    });

    $('.confirm-restore').on('click', function() {
        var recordId = $('#restore-record-id').val();

        $.ajax({
            url: 'restore_immun_record.php',
            type: 'POST',
            data: { id: recordId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Record has been restored.',
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
  </body>
</html>
