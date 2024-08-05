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
    <style>
      .content-wrapper {
        overflow-y: auto;
      }

      .card-body {
        display: flex;
        flex-direction: column;
        height: 100%;
      }

      .chart-container {
        flex: 1;
      }

      .table-container {
        overflow-y: auto;
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
                  <span class="fa fa-tachometer-alt"></span> Dashboard
                </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
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

        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-12 col-md-12 mb-12">
            <div class="card">
              <div class="card-body elevation-2">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-hospital-user text-info fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Patients</h4>
                      <p class="mb-4">Number of Patients</p>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <h2 class="h1 mb-4"><?php echo $total_patients; ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-12 mb-12">
            <div class="card">
              <div class="card-body elevation-2">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-baby text-info fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Children</h4>
                      <p class="mb-4">Number of Children</p>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <h2 class="h1 mb-4"><?php echo $total_children; ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-12 mb-12">
            <div class="card">
              <div class="card-body elevation-2">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-syringe text-info fa-3x me-4"></i>
                    </div>
                    <div>
                      <h4>Immunized</h4>
                      <p class="mb-4">Number of Immunized Children</p>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <h2 class="h1 mb-4"><?php echo $total_immunizations; ?></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- HTML -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body table-container">
                    <div class="chart-title">
                        <h4>Expected Deliveries per Month</h4>
                    </div>
                    <table class="table table-bordered mytable" id="prenatal-table">
                        <tbody>
                            <!-- Data will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body chart-container">
                    <div class="chart-title">
                        <h4>Graphical Representation Expected Deliveries per Month</h4><br>
                    </div>
                    <canvas id="bargraph"></canvas>
                </div>
            </div>
        </div>
        <!-- Chart Container for the Second Chart -->
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body chart-container">
                    <div class="chart-title">
                        <h4>Patient Status Distribution</h4>
                    </div>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../asset/jquery/jquery.min.js"></script>
<script src="../asset/js/chart.js"></script>

<script>
$(document).ready(function() {
    // Fetch expected delivery data
    $.ajax({
        url: 'fetch_expected_delivery_data.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate the table
            var tableBody = $('#prenatal-table tbody');
            tableBody.empty();
            data.months.forEach(function(month, index) {
                var patientIds = data.patient_ids[index].join(','); // Join IDs into a comma-separated string
                tableBody.append('<tr><td><a href="#" class="month-link" data-month="' + encodeURIComponent(month) + '" data-patient-ids="' + encodeURIComponent(patientIds) + '">' + month + '</a></td><td>' + data.counts[index] + '</td></tr>');
            });

            // Create bar chart
            var barChartData = {
                labels: data.months,
                datasets: [{
                    label: 'Expected Deliveries',
                    backgroundColor: 'rgb(79,129,189)',
                    borderColor: 'rgba(0, 158, 251, 1)',
                    borderWidth: 1,
                    data: data.counts
                }]
            };

            var ctx = document.getElementById('bargraph').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    onClick: function(evt, item) {
                        if (item.length > 0) {
                            var index = item[0].index;
                            var month = data.months[index];
                            var patientIds = data.patient_ids[index].join(','); // Join IDs into a comma-separated string
                            // Redirect to the page with month and patient_ids parameters
                            window.location.href = 'prenatal.php?month=' + encodeURIComponent(month) + '&patient_ids=' + encodeURIComponent(patientIds);
                        }
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
                                text: 'Number of Deliveries'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Handle table link clicks
            $('#prenatal-table').on('click', '.month-link', function(e) {
                e.preventDefault(); // Prevent the default link behavior
                var month = $(this).data('month');
                var patientIds = $(this).data('patient-ids');
                // Redirect to the page with month and patient_ids parameters
                window.location.href = 'prenatal.php?month=' + encodeURIComponent(month) + '&patient_ids=' + encodeURIComponent(patientIds);
            });

        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
        }
    });



 //2nd chart


    // Fetch patient status data
// Fetch patient status data
$.ajax({
    url: 'fetch_patient_status_data.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        var statusChartData = {
            labels: data.statuses,
            datasets: [{
                label: 'Patient Status Distribution',
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#DAF7A6'],
                data: data.counts
            }]
        };

        var ctxStatus = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctxStatus, {
            type: 'pie',
            data: statusChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (context.parsed > 0) {
                                    label += ': ' + context.parsed + ' patients';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Add click event listener
        ctxStatus.canvas.addEventListener('click', function(event) {
            var activePoints = statusChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, true);
            if (activePoints.length) {
                var index = activePoints[0].index;
                var status = statusChartData.labels[index];
                // Redirect to prenatal.php with status parameter
                window.location.href = 'prenatal.php?status=' + encodeURIComponent(status);
            }
        });
    },
    error: function(xhr, status, error) {
        console.error('AJAX request failed:', status, error);
    }
});






});
</script>








  </body>
</html>
