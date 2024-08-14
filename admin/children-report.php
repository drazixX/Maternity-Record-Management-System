
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Maternity-Record-Management-System</title>
      <link rel="shortcut icon" type="image/png" sizes="16x16" href="/MRM/asset/img/baby1.png">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
      <link rel="stylesheet" href="../asset/css/style.css">
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-light elevation-1" style="background-color: rgba(131,219,214);">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
               </li>
            </ul>
            <!-- Right navbar links -->
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
                  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <img src="../asset/img/avatar.png" class="img-circle elevation-2" alt="User Image" width="30">
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                  </a>
               </li>
<!-- Logout Button -->
<li class="nav-item">
  <a class="nav-link" data-toggle="modal" data-target="#logoutConfirmModal">
    <i class="fas fa-sign-out-alt"></i> Logout
  </a>
</li>
            </ul>
         </nav>
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
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
              <a href="children-report.php" class="nav-link">
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
                        <h1 class="m-0"><span class="fa fa-chart-pie"></span> Reports</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Reports</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Table for Children Per Month -->
            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Children Per Month</h4><br>
                            <label for="year-select">Select Year:</label>
                            <select id="year-select" class="form-control" style="width: auto; display: inline-block;">
                                <!-- Options will be populated dynamically -->
                            </select>
                            <br>
                        </div>
                        <table class="table table-bordered mytable">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Number of Children</th>
                                </tr>
                            </thead>
                            <tbody id="immunization-table-body">
                                <!-- Data will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Bar Graph for Vaccinated Children -->
            <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Graphical Representation of Children</h4><br>
                        </div>
                        <canvas id="bargraph"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- JavaScript for Dynamic Content -->
<script src="../asset/jquery/jquery.min.js"></script>
<script src="../asset/js/adminlte.js"></script>
<script src="../asset/js/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Fetch available years
    fetchAvailableYears();

    // Fetch data initially for the default year
    $('#year-select').change(function () {
        fetchImmunizationData($(this).val());
    });

    function fetchAvailableYears() {
        $.ajax({
            url: 'fetch_child_years.php', // This script should fetch years from the 'child' table
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var yearSelect = $('#year-select');
                yearSelect.empty();
                data.years.forEach(function (year) {
                    yearSelect.append('<option value="' + year + '">' + year + '</option>');
                });

                // Fetch data for the first available year by default
                if (data.years.length > 0) {
                    fetchImmunizationData(data.years[0]);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }

    function fetchImmunizationData(year) {
        $.ajax({
            url: 'fetch_child_data.php', // This script should fetch data from the 'child' table
            method: 'GET',
            data: { year: year },
            dataType: 'json',
            success: function (data) {
                // Populate the table
                var tableBody = $('#immunization-table-body');
                tableBody.empty();
                data.months.forEach(function (month, index) {
                    var row = $('<tr>').append(
                        '<td><button class="btn btn-link" style="padding: 0; border: none; background: none;" title="Click to show full details" onclick="redirectToMonth(\'' + encodeURIComponent(month) + '\')">' + month + '</button></td>' +
                        '<td>' + data.counts[index] + '</td>'
                    );
                    tableBody.append(row);
                });

                // Create bar chart
                var barChartData = {
                    labels: data.months,
                    datasets: [{
                        label: 'Number of Children',
                        backgroundColor: 'rgb(79,129,189)',
                        borderColor: 'rgba(0, 158, 251, 1)',
                        borderWidth: 1,
                        data: data.counts
                    }]
                };

                var ctx = document.getElementById('bargraph').getContext('2d');
                if (window.myBar) {
                    window.myBar.destroy();
                }
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        legend: {
                            display: false,
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Month'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Number of Children'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }
});

function redirectToMonth(month) {
    var year = $('#year-select').val();
    window.location.href = 'child.php?month=' + month + '&year=' + year;
}
</script>






   </body>
</html>