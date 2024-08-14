      <!-- <?php
// Assuming you have started the session and have user information in session variables
session_start();

// Fetch the user_type from the session
$user_type = $_SESSION['user_type'] ?? '';

// You can also fetch it directly from the database if needed
// Example: $user_type = fetchUserTypeFromDatabase($user_id);
?> -->
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
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- DataTables CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
    
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="../asset/css/adminlte.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../asset/css/style.css">
    
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
    


<!-- For calendar styyling -->
<style type="text/css">
   .calendar-title {
            text-align: center;
            margin-bottom: 10px; /* Adjust spacing between the title and calendar */
            font-size: 1.5rem; /* Adjust the font size as needed */
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .calendar-title i {
            margin-right: 10px; /* Space between icon and text */
        }
        #calendar {
            max-width: 800px; /* Adjust calendar width as needed */
            margin: 0 auto; /* Center the calendar horizontally */
        }
</style>

<!-- For calendar size -->
<style type="text/css">
    #calendar {
        max-width: 800px; /* Adjust this value as needed */
        margin: 0 auto; /* Center align the calendar */
        height: 600px; /* Adjust height as needed */
    }
</style>


<style>
  .nav-treeview {
    padding-left: 20px;
  }
</style>

<style>
  .nav-treeview {
    padding-left: 20px;
  }
</style>

    <!-- Custom Internal Styles -->
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

      .btn-heading {
        background: none;
        border: none;
        font-size: 1.5rem; /* Adjust size to match your headings */
        font-weight: bold;
        color: #333; /* Change color if needed */
        text-align: left;
        padding: 0;
        cursor: pointer;
      }
    
      .btn-heading:hover {
        color: #007bff; /* Change color on hover if needed */
        text-decoration: underline; /* Optional underline on hover */
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
     

        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-4 col-md-12 mb-12">
            <div class="card">
              <div class="card-body elevation-2">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-hospital-user text-info fa-3x me-4"></i>
                    </div>
                    <div>
                    <h4>
    <button class="btn btn-heading" onclick="window.location.href='patient.php'" title= 'Click to Show Patients list'>Patients</button>
</h4>
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
          <div class="col-xl-4 col-md-12 mb-12">
            <div class="card">
              <div class="card-body elevation-2">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-baby text-info fa-3x me-4"></i>
                    </div>
                    <div>
                    <h4>
    <button class="btn btn-heading" onclick="window.location.href='child.php'"  title= 'Click to Show Childrens List'>Children</button>
</h4>
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
          <div class="col-xl-4 col-md-12 mb-12">
            <div class="card">
              <div class="card-body elevation-2">
                <div class="d-flex justify-content-between p-md-1">
                  <div class="d-flex flex-row">
                    <div class="align-self-center">
                      <i class="fa fa-syringe text-info fa-3x me-4"></i>
                    </div>
                    <div>
                    <h4>
    <button class="btn btn-heading" onclick="window.location.href='immunization.php'"  title= 'Click to Show Immunized List'>Immunized</button>
</h4>
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
<!-- Expected Deliveries table -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body table-container">
                    <div class="chart-title">
                        <h4>Expected Deliveries per Month</h4>
                        <label for="year-select">Select Year:</label>
<select id="year-select">
    <!-- Options will be populated dynamically -->
</select>

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

<div class="col-12 col-md-6 col-lg-6 col-xl-4">
    <div class="card">
        <div class="card-body table-container">
            <div class="chart-title">
                <h4>Patient Status Distribution</h4>
                
<label for="status-year">Select Year:</label>
<select id="status-year">
    <!-- Options will be populated dynamically -->
</select>
            </div>
            <table class="table table-bordered mytable" id="patientStatusTable">
                <tbody>
                    <!-- Data will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-6 col-xl-8">
    <div class="card">
        <div class="card-body chart-container">
            <div class="chart-title">
                <h4>Graphical Representation Patient Status Distribution</h4>
            </div>
            <canvas id="statusChart"></canvas>
        </div>
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

<!-- For calendar display -->
<div class="container-fluid">
        <!-- Calendar Title -->
        <div class="calendar-title">
            <i class="fas fa-calendar-alt"></i>
            <h3>Prenatal Schedules Calendar</h3>
        </div>

        <!-- FullCalendar Container -->
        <div id="calendar"></div>
    </div>




<!-- jQuery -->
<script src="../asset/jquery/jquery.min.js"></script>
<script src="../asset/js/chart.js"></script>




<script>
  
document.addEventListener('DOMContentLoaded', function() {
    const cancelButtons = document.querySelectorAll('.cancel-schedule-btn');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const patientId = this.getAttribute('data-id');
            document.getElementById('scheduleId').value = patientId;
        });
    });

    // Initialize FullCalendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: function(fetchInfo, successCallback, failureCallback) {
            fetch('fetch_prenatal_schedules.php') // Updated endpoint
                .then(response => response.json())
                .then(data => {
                    // Assuming data is in the format FullCalendar expects
                    successCallback(data);
                })
                .catch(error => {
                    console.error('Error fetching prenatal schedules:', error);
                    failureCallback(error);
                });
        },
        eventColor: '#378006', // Custom color for events
        height: 'auto', // Ensure calendar height adjusts to content
        eventContent: function(arg) {
            let customHtml = `
                <div class="fc-event-title fc-sticky">
                    ${arg.event.title} <!-- Display the patient's name here -->
                </div>
            `;
            return { html: customHtml };
        }
    });
    calendar.render();
});
</script>

<!-- other  -->
<script>
$(document).ready(function() {
    // Fetch years for the dropdown
    $.ajax({
        url: 'fetch_years.php', // Create this PHP file to return available years
        method: 'GET',
        dataType: 'json',
        success: function(yearData) {
            var yearSelect = $('#year-select');
            yearSelect.empty(); // Clear existing options
            yearData.years.forEach(function(year) {
                yearSelect.append('<option value="' + year + '">' + year + '</option>');
            });
            
            // Fetch and display data for the default selected year
            var defaultYear = yearSelect.val();
            fetchExpectedDeliveryData(defaultYear);
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
        }
    });

    // Handle year selection change
    $('#year-select').change(function() {
        var selectedYear = $(this).val();
        fetchExpectedDeliveryData(selectedYear);
    });

    // Function to fetch and display expected delivery data based on the selected year
    function fetchExpectedDeliveryData(year) {
        $.ajax({
            url: 'fetch_expected_delivery_data.php',
            method: 'GET',
            data: { year: year }, // Send year as a parameter
            dataType: 'json',
            success: function(data) {
                // Populate the table
                var tableBody = $('#prenatal-table tbody');
                tableBody.empty();
                data.months.forEach(function(month, index) {
                    tableBody.append('<tr><td><a href="#" class="month-link" data-month="' + encodeURIComponent(month) + '" data-year="' + encodeURIComponent(year) + '" title="Click to show full details">' + month + '</a></td><td>' + data.counts[index] + '</td></tr>');
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
                        // onClick: function(evt, item) {
                        //     if (item.length > 0) {
                        //         var index = item[0].index;
                        //         var month = data.months[index];
                        //         // Redirect to the page with month and year parameters
                        //         window.location.href = 'prenatal.php?month=' + encodeURIComponent(month) + '&year=' + encodeURIComponent(year);
                        //     }
                        // },
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
                    var year = $(this).data('year');
                    // Redirect to the page with month and year parameters
                    window.location.href = 'prenatal.php?month=' + encodeURIComponent(month) + '&year=' + encodeURIComponent(year);
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }
});


</script>


<script>




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

        // Populate the table with data
        var tableBody = $('#patientStatusTable tbody');
        tableBody.empty(); // Clear existing data
        for (var i = 0; i < data.statuses.length; i++) {
            var row = $('<tr></tr>');
            row.append('<td>' + data.statuses[i] + '</td>');
            row.append('<td>' + data.counts[i] + '</td>');
            row.append('<td><button class="btn btn-primary filter-btn" data-status="' + data.statuses[i] + '" data-ids="' + data.ids[i].join(',') + '">Show</button></td>');
            tableBody.append(row);
        }

        // Add click event listener to filter buttons
        $('#patientStatusTable tbody').on('click', '.filter-btn', function() {
            var status = $(this).data('status');
            var patientIds = $(this).data('ids');
            // Redirect to prenatal.php with status and patient IDs parameters
            window.location.href = 'prenatal.php?status=' + encodeURIComponent(status) + '&patient_ids=' + encodeURIComponent(patientIds);
        });
    },
    error: function(xhr, status, error) {
        console.error('AJAX request failed:', status, error);
    }
});






</script>

<!-- Status year select -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch years from the server
    function fetchYears() {
        fetch('fetch_status_years.php')
            .then(response => response.json())
            .then(data => populateYearSelect(data))
            .catch(error => console.error('Error fetching years:', error));
    }

    // Function to populate the select element with the fetched years
    function populateYearSelect(years) {
        const yearSelect = document.getElementById('status-year');
        const currentYear = new Date().getFullYear();
        yearSelect.innerHTML = '<option value="">Select Year</option>'; // Default option

        years.forEach(year => {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        });

        // Set the current year as default if available
        if (years.includes(currentYear.toString())) {
            yearSelect.value = currentYear;
            fetchPatientStatusData(currentYear); // Fetch data for the current year by default
        }

        // Add event listener to fetch data when the year is selected
        yearSelect.addEventListener('change', function() {
            const selectedYear = this.value;
            if (selectedYear) {
                fetchPatientStatusData(selectedYear);
            }
        });
    }

    // Function to fetch patient status data based on selected year
    function fetchPatientStatusData(year) {
        $.ajax({
            url: 'fetch_patient_status_data.php',
            method: 'GET',
            data: { year: year },
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

                // Populate the table with data
                var tableBody = $('#patientStatusTable tbody');
                tableBody.empty(); // Clear existing data
                for (var i = 0; i < data.statuses.length; i++) {
                    var row = $('<tr></tr>');
                    row.append('<td>' + data.statuses[i] + '</td>');
                    row.append('<td>' + data.counts[i] + '</td>');
                    row.append('<td><button class="btn btn-primary filter-btn" data-status="' + data.statuses[i] + '" data-ids="' + data.ids[i].join(',') + '">Show</button></td>');
                    tableBody.append(row);
                }

                // Add click event listener to filter buttons
                $('#patientStatusTable tbody').on('click', '.filter-btn', function() {
                    var status = $(this).data('status');
                    var patientIds = $(this).data('ids');
                    // Redirect to prenatal.php with status and patient IDs parameters
                    window.location.href = 'prenatal.php?status=' + encodeURIComponent(status) + '&patient_ids=' + encodeURIComponent(patientIds);
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    }

    // Fetch years and initial data on page load
    fetchYears();
});
</script>


<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>


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

    
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE JS -->
    <script src="../asset/js/adminlte.min.js"></script>
    
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    
    <!-- Custom JS -->
    <script src="path/to/your/custom.js"></script>
    <script>
  function toggleSubMenu(element) {
    var submenu = element.nextElementSibling;
    if (submenu.style.display === "none" || submenu.style.display === "") {
      submenu.style.display = "block";
    } else {
      submenu.style.display = "none";
    }
  }
</script>


<script>
  function toggleSubMenu(element) {
    var submenu = element.nextElementSibling;
    if (submenu.style.display === "none" || submenu.style.display === "") {
      submenu.style.display = "block";
    } else {
      submenu.style.display = "none";
    }
  }
</script>



  </body>
</html>
