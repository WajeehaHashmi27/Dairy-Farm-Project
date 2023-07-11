<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION["username"]) == false) {
  // Redirect the user to the login page or perform any other action
  header("Location: login.php");
  // Stop executing the rest of the code
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cattlehub";
$conn = mysqli_connect($servername, $username, $password, $database);
$showAlert = false;
$showError = false;
?>
<?php
$sql = "SELECT * FROM notifications ORDER BY id DESC LIMIT 5"; // Adjust the query as per your requirement
$result = $conn->query($sql);
$notifications = [];

if ($result->num_rows > 0) {
  // Loop through the result set and store notification data in an array
  while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
  }
}
$sql = "SELECT COUNT(*) AS record_count FROM notifications";
$result = $conn->query($sql);
$recordCount = 0;

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $recordCount = $row['record_count'];
}

// Close the connection

?>


<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/dt-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 13:15:13 GMT -->

<head>
  <title>Animals list</title>

  <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
  <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
  <meta name="author" content="colorlib" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon" />

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css" />

  <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all" />

  <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css" />

  <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css" />

  <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css" />

  <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css" />

  <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" />

  <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css" />
</head>



<body>

  <div class="loader-bg">
    <div class="loader-bar"></div>
  </div>

  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

      <nav class="navbar header-navbar pcoded-header" style="height: 72px;">
        <div class="navbar-wrapper">
          <div class="navbar-logo">
            <a href="../dashboard-crm.html">
              <img class="img-fluid" src="../files/assets/images/logo.png" style="width:180px;" alt="Theme-Logo" />
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
              <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
              <i class="feather icon-more-horizontal"></i>
            </a>
          </div>
          <div class="navbar-container container-fluid">
            <ul class="nav-left">
              <!-- Full screen -->
              <li>
                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                  <i class="full-screen feather icon-maximize"></i>
                </a>
              </li>
            </ul>
            <!-- notification -->
            <?php
            // Calculate total reads and total unreads
            // Calculate total reads and total unreads

            // Query to fetch all notifications
            $sql = "SELECT * FROM notifications";
            $result = $conn->query($sql);
            $totalReads = 0;
            $totalUnreads = 0;
            if ($result->num_rows > 0) {


              while ($row = $result->fetch_assoc()) {
                if ($row['Status'] == 'read') {
                  $totalReads++;
                } else {
                  $totalUnreads++;
                }
              }
            }

            // Close the database connection
            ?>
            <ul class="nav-right">
              <li class="header-notification">
                <div class="dropdown-primary dropdown">
                  <div class="dropdown-toggle" data-toggle="dropdown">
                    <i class="feather icon-bell"></i>
                    <span class="badge bg-c-red"><?php echo $recordCount; ?></span>
                  </div>
                  <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <td>
                      <label class="label label-success" style="margin-left: 210px; padding: 12px; display:inline-block margin-top: 5 px">
                        Unread: <?php echo $totalUnreads; ?> Read: <?php echo $totalReads; ?>
                      </label>
                    </td>

                    <?php foreach ($notifications as $notification) : ?>

                      <li>

                        <div class="media">
                          <div class="media-body">
                            <h5 class="notification-user"><?php echo $notification['Content']; ?></h5>
                            <p class="notification-msg"></p>
                            <span class="notification-time"><?php echo $notification['Timestamp']; ?></span>
                          </div>
                        </div>
                      </li>
                    <?php endforeach; ?>
                    <?php if (count($notifications) == 0) : ?>
                      <li>
                        <div class="media">
                          <div class="media-body">
                            <p>No new notifications</p>
                          </div>
                        </div>
                      </li>
                    <?php endif; ?>
                    <li>
                      <div class="media">
                        <div class="media-body">
                          <a href="not-details.php" class="see-all-link" style=" color: darkblue; font-weight: bold; text-decoration: underline; font-size: 16px; margin-left:130px;">See All</a>
                        </div>
                      </div>
                    </li>


                  </ul>
                </div>
              </li>
              <!-- Profile -->
              <li class="user-profile header-notification">
                <div class="dropdown-primary dropdown">
                  <div class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../files/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                    <span>Admin</span>
                    <i class="feather icon-chevron-down"></i>
                  </div>
                  <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li>
                      <a href="profile.php">
                        <i class="feather icon-user"></i> Profile
                      </a>
                    </li>
                    <li>
                      <form method="POST">
                        <button type="button" name="logout" style="border: none; background: none; padding-left: 2px;  font-size: 15px;  outline: none;
    color: rgba(0, 0, 0, 0.8);" onclick="logoutSuccess()">
                          <i class="feather icon-log-out"></i> Logout
                        </button>
                      </form>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Side Bar -->
      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">

          <nav class="pcoded-navbar">
            <div class="nav-list">
              <div class="pcoded-inner-navbar main-menu">
                <div class="pcoded-navigation-label">Navigation</div>
                <ul class="pcoded-item pcoded-left-item">
                  <li class>
                    <a href="dashboard-crm.php" class="waves-effect waves-dark">
                      <span class="pcoded-micon">
                        <i class="fa-solid fa-house"></i>
                      </span>
                      <span class="pcoded-mtext">Dashboard</span>
                    </a>
                  </li>

                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="fa-solid fa-cow"></i></span>
                      <span class="pcoded-mtext">Animals</span>
                    </a>
                    <ul class="pcoded-submenu">

                      <li class>
                        <a href="list-animal.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">List Animal</span>
                        </a>
                      </li>
                      <li class>
                        <a href="add-animal.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Add Animal</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class>
                    <a href="charts.php" class="waves-effect waves-dark">
                      <span class="pcoded-micon">
                        <i class="fa-solid fa-chart-simple"></i>
                      </span>
                      <span class="pcoded-mtext">Charts</span>
                    </a>

                  </li>
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon"><i class="fa-solid fa-layer-group"></i></span>
                      <span class="pcoded-mtext">Groups</span>
                    </a>
                    <ul class="pcoded-submenu">

                      <li class>
                        <a href="list-group.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">List Group</span>
                        </a>
                      </li>

                    </ul>
                  </li>
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon">
                        <i class="feather icon-sidebar"></i>
                      </span>
                      <span class="pcoded-mtext">Diet Plan</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class>
                        <a href="list-diet-plan.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Assign Diet Plan</span>
                        </a>
                      </li>
                      <li class>
                        <a href="add-diet-plan.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Add Diet Plan</span>
                        </a>
                      </li>
                      <li class>
                        <a href="assigned-diet-plan.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Diet Plan History</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon">
                        <i class="fa-solid fa-industry"></i>
                      </span>
                      <span class="pcoded-mtext">Milk Production</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class>
                        <a href="milk-production.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Add Milk production</span>
                        </a>
                      </li>

                      <li class>
                        <a href="milkproductionrecords.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Milk production history</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                      <span class="pcoded-micon">
                        <i class="feather icon-clipboard"></i>
                      </span>
                      <span class="pcoded-mtext">Reports</span>
                    </a>
                    <ul class="pcoded-submenu">
                      <li class>
                        <a href="dailyreport.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Daily Reports</span>
                        </a>
                      </li>

                      <li class>
                        <a href="weeklyreport.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Weekly Reports</span>
                        </a>
                      </li>
                      <li class>
                        <a href="monthlyreport.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Monthly Reports</span>
                        </a>
                      </li>
                      <li class>
                        <a href="yearlyreport.php" class="waves-effect waves-dark">
                          <span class="pcoded-mtext">Yearly Reports</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- Main Content -->
          <div class="pcoded-content">
            <div class="page-header card">
              <div class="row align-items-end">
                <div class="col-lg-8">
                  <div class="page-header-title">
                    <i class="feather icon-sidebar bg-c-blue"></i>
                    <div class="d-inline">
                      <h5>List Groups</h5>
                      <span>Displaying all the Groups</span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="page-header-breadcrumb">
                    <ul class="breadcrumb breadcrumb-title">
                      <li class="breadcrumb-item">

                        <i class="feather icon-home"></i>
                      </li>
                      <li class="breadcrumb-item" style="font-size:14px">
                        Groups
                      </li>
                      <li class="breadcrumb-item" style="font-size:14px">
                        List Groups
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="pcoded-inner-content">
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="page-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h5>List of Groups</h5>
                            <span>DataTables has most features enabled by
                              default, so all you need to do to use it with
                              your own ables is to call the construction
                              function: $().DataTable();.</span>
                          </div>
                          <div class="card-block">
                            <div class="dt-responsive table-responsive">
                              <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Group</th>

                                  </tr>
                                </thead>
                                <tbody>
                                  <?php

                                  $sql = "SELECT * FROM animals";
                                  $result = $conn->query($sql);

                                  // Check if records are found
                                  if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                      echo "<tr>";
                                      echo "<td>" . $row['Id'] . "</td>";
                                      echo "<td>" . $row['Name'] . "</td>";
                                      echo "<td>" . $row['grp'] . "</td>";


                                      echo "</tr>";
                                    }
                                  } else {
                                    echo "<tr><td colspan='8'>No records found.</td></tr>";
                                  }

                                  // Close the database connection
                                  $conn->close();
                                  ?>

                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Group</th>


                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
  <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
  <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>

  <script src="../files/assets/pages/waves/js/waves.min.js"></script>

  <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

  <script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
  <script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>

  <script src="../files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../files/assets/pages/data-table/js/jszip.min.js"></script>
  <script src="../files/assets/pages/data-table/js/pdfmake.min.js"></script>
  <script src="../files/assets/pages/data-table/js/vfs_fonts.js"></script>
  <script src="../files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

  <script src="../files/assets/pages/data-table/js/data-table-custom.js"></script>
  <script src="../files/assets/js/pcoded.min.js"></script>
  <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
  <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script type="text/javascript" src="../files/assets/js/script.js"></script>
  <!-- Place this code at the bottom of the body section, just before the closing </body> tag -->
  <script>
    // Capture the click event on the "Delete" button
    document.addEventListener('click', function(e) {
      var target = e.target;
      if (target.classList.contains('btn-delete')) {
        e.preventDefault();

        // Get the ID of the record to be deleted
        var id = target.getAttribute('data-id');

        // Confirm the deletion
        if (confirm('Are you sure you want to delete this record?')) {
          // Send an AJAX request to delete.php
          $.ajax({
            url: 'delete.php',
            type: 'GET',
            data: {
              id: id
            },
            success: function(response) {
              // Handle the response
              alert(response); // Display a success message or perform any additional tasks

              // Remove the deleted row from the table
              var tableRow = target.closest('tr');
              tableRow.parentNode.removeChild(tableRow);
            },
            error: function(xhr, status, error) {
              // Handle the error
              alert('An error occurred while deleting the record.');
              console.log(xhr.responseText);
            }
          });
        }
      }
    });
  </script>
  <script>
    // Display the logout success message and redirect after a delay
    function logoutSuccess() {
      alert("Logout successful");

      window.location.href = "login.php";
    }
  </script>

</body>

</html>