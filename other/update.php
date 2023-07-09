
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

<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 13:13:41 GMT -->

<head>
    <title>Update</title>


    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../files/bower_components/jquery.steps/css/jquery.steps.css">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css">
</head>

<body>

<div class="loader-bg">
    <div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper" >

        <nav class="navbar header-navbar pcoded-header" style="height: 72px;">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="../dashboard-crm.html">
                        <img class="img-fluid" src="../files/assets/images/logo.png" style="width:180px;"
                            alt="Theme-Logo" />
                    </a>
                    <a class="mobile-menu" id="mobile-collapse" href="#!" >
                        <i class="feather icon-menu icon-toggle-right" ></i>
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-left" >
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
                                <ul class="show-notification notification-view dropdown-menu"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <td>
                <label class="label label-success" style="margin-left: 210px; padding: 12px; display:inline-block margin-top: 5 px">
                    Unread: <?php echo $totalUnreads; ?> Read: <?php echo $totalReads;?>
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
                                    <img src="../files/assets/images/avatar-4.jpg" class="img-radius"
                                        alt="User-Profile-Image">
                                    <span>Admin</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="profile.php">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li><li>
                                    <form method="POST">
<button type="button" name="logout" style="border: none; background: none; padding-left: 2px;  font-size: 15px;  outline: none;
    color: rgba(0, 0, 0, 0.8);" onclick="logoutSuccess()">
    <i class="feather icon-log-out" ></i> Logout
</button>
</form> </li>
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





                    <div class="pcoded-content">
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-tv bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Animals</h5>
                                            <span>Add new Animals</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                      <ul class="breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                          
                        <a href="dashboard-crm.php"><i class="feather icon-home"></i></a>
                          
                        </li>
                        <li class="breadcrumb-item">
                          <a href="#!">Animals</a>
                        </li>
                        <li class="breadcrumb-item">
                          <a href="#!">Add Aniamls</a>
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
                                                        <h5>Add Animal</h5>
                                                        <span>Add class of <code>.form-control</code> with
                                                            <code>&lt;input&gt;</code> tag</span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div id="wizard">
                                                                    <section>
                                                                    <?php
                                                                    if (isset($_POST['id'])) {
                                                                        $id = $_POST['id'];
                                                                    
                                                                        // Perform your database query here to fetch the data for the given ID
                                                                    
                                                                        // Example query to retrieve data based on the ID
                                                                        $query = "SELECT * FROM animals WHERE Id = " . $id;
                                                                        $result = mysqli_query($conn, $query);
                                                                    
                                                                        // Check if the query was successful and fetch the data
                                                                    
if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    
    echo '<form class="wizard-form" id="example-advanced-form" action="process_update.php" method="POST">';
    echo '<h3> Basic Information </h3>';
    echo '<fieldset>';
    echo "<input type='hidden' name='id' value='" . $row['Id'] . "'>";
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo '<label for="userName-2" class="block">Name *</label>';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<input id="userName-2" name="userName" type="text" class="required form-control" value="' . $row['Name'] . '">';
    echo '</div>';
    echo '</div>';
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo '<label for="email-2" class="block">Age *</label>';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<input id="email-2" name="email" type="number" class="required form-control" value="' . $row['Age'] . '">';
    echo '</div>';
    echo '</div>';
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo '<label for="password-2" class="block">Gender *</label>';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<div class="radio radio-inline">';
    echo '<label>';
    echo '<input type="radio" style="display: inline;" name="gender" value="Male"';
    if ($row['Gender'] == 'Male') {
        echo ' checked';
    }
    echo '> Male';
    echo '</label>';
    echo '</div>';
    echo '<div class="radio radio-inline">';
    echo '<label>';
    echo '<input type="radio" style="display: inline;" name="gender" value="Female"';
    if ($row['Gender'] == 'Female') {
        echo ' checked';
    }
    echo '> Female';
    echo '</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</fieldset>';
    echo '<h3> General Information </h3>';
    echo '<fieldset>';
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo '<label for="phone-2" class="block">Temperature</label>';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<input id="phone-2" name="temperature" type="number" class="form-control phone" value="' . $row['Temperature'] . '">';
    echo '</div>';
    echo '</div>';
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo '<label for="phone-2" class="block">Price</label>';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<input id="phone-2" name="price" type="number" class="form-control phone" value="' . $row['Price'] . '">';
    echo '</div>';
    echo '</div>';
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo '<label for="date" class="block">Pregnant</label>';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<div class="radio radio-inline">';
    echo '<label>';
    echo '<input type="radio" style="display: inline;" name="pregnant" value="Yes"';
    if ($row['Pregnant'] == 'Yes') {
        echo ' checked';
    }
    echo '> Yes';
    echo '</label>';
    echo '</div>';
    echo '<div class="radio radio-inline">';
    echo '<label>';
    echo '<input type="radio" style="display: inline;" name="pregnant" value="No"';
    if ($row['Pregnant'] == 'No') {
        echo ' checked';
    }
    echo '> No';
    echo '</label>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="form-group row">';
    echo '<div class="col-md-4 col-lg-2">';
    echo 'Breed</div>';
    echo '<div class="col-md-8 col-lg-10">';
    echo '<select class="form-control required" name="breed">';
    echo '<option>Select Breed</option>';
    echo '<option value="Holstein"';
    if ($row['Breed'] == 'Holstein') {
        echo ' selected';
    }
    echo '>Holstein</option>';
    echo '<option value="Jersey"';
    if ($row['Breed'] == 'Jersey') {
        echo ' selected';
    }
    echo '>Jersey</option>';
    echo '<option value="Ayrshire"';
    if ($row['Breed'] == 'Ayrshire') {
        echo ' selected';
    }
    echo '>Ayrshire</option>';
    echo '<option value="Guernsey"';
    if ($row['Breed'] == 'Guernsey') {
        echo ' selected';
    }
    echo '>Guernsey</option>';
    echo '<option value="Hereford"';
    if ($row['Breed'] == 'Hereford') {
        echo ' selected';
    }
    echo '>Hereford</option>';
    echo '<option value="Simmental"';
    if ($row['Breed'] == 'Simmental') {
        echo ' selected';
    }
    echo '>Simmental</option>';
    echo '<option value="Angus"';
    if ($row['Breed'] == 'Angus') {
        echo ' selected';
    }
    echo '>Angus</option>';
    echo '</select>';
    echo '</div>';
    echo '</div>';
    

} else {
    echo '<p>No records found.</p>';
}
                                                                    }

?>

                                                                  
                                                                            
                                                                            <button
                              style="margin-left: 850px; margin-top: 40px"
                                type="submit"
                                class="btn btn-primary waves-effect waves-light"
                                name="finish"
                                id="primary-popover-content"
                                data-container="body"
                                data-toggle="popover"
                                title="Primary color states"
                                data-placement="bottom"
                                data-content="<div class='color-code'>
                                                            <div class='row'>
                                                              <div class='col-sm-6 col-xs-12'>
                                                                <span class='block'>Normal</span>
                                                                <span class='block'>
                                                                  <small>#4680ff</small>
                                                              </span>
                                                          </div>
                                                          <div class='col-sm-6 col-xs-12'>
                                                            <div class='display-color' style='background-color:#4680ff;'></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class='color-code'>
                                                  <div class='row'>
                                                    <div class='col-sm-6 col-xs-12'>
                                                      <span class='block'>Hover</span>
                                                      <span class='block'>
                                                        <small>#79a3ff</small>
                                                    </span>
                                                </div>
                                                <div class='col-sm-6 col-xs-12'>
                                                  <div class='display-color' style='background-color:#79a3ff;'></div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class='color-code'>
                                          <div class='row'>
                                            <div class='col-sm-6 col-xs-12'>
                                              <span class='block'>Active</span>
                                              <span class='block'>
                                                <small>#0956ff</small>
                                            </span>
                                        </div>
                                        <div class='col-sm-6 col-xs-12'>
                                          <div class='display-color' style='background-color:#0956ff;'></div>
                                      </div>
                                  </div>
                              </div>

                              <div class='color-code'>
                                  <div class='row'>
                                    <div class='col-sm-6 col-xs-12'>
                                      <span class='block'>Disabled</span>
                                      <span class='block'>
                                        <small>#c3d5ff</small>
                                    </span>
                                </div>
                                <div class='col-sm-6 col-xs-12'>
                                  <div class='display-color' style='background-color:#c3d5ff;'></div>
                              </div>
                          </div>
                      </div>

                      "
                              >
                                Finish
                              </button>                                  <!-- Finish button -->
                                                                                                        
        
    

                                                                            </fieldset>
                                                                            
                                                                        
                                                                    
     
                                                                            
                                                                            
                                                                        </form>
                                                                        
                                                                    </section>
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

            <script type="text/javascript"
                src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

            <script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
            <script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>

            <script src="../files/bower_components/jquery.cookie/js/jquery.cookie.js"></script>
            <script src="../files/bower_components/jquery.steps/js/jquery.steps.js"></script>
            <script src="../files/bower_components/jquery-validation/js/jquery.validate.js"></script>

            <script src="../../../cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
            <script src="../../../cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
            <script type="text/javascript" src="../files/assets/pages/form-validation/validate.js"></script>

            <script src="../files/assets/pages/forms-wizard-validation/form-wizard.js"></script>
            <script src="../files/assets/js/pcoded.min.js"></script>
            <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
            <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
            <script type="text/javascript" src="../files/assets/js/script.js"></script>
            <script>
    // Display the logout success message and redirect after a delay
    function logoutSuccess() {
        alert("Logout successful");
        
        window.location.href = "login.php";
    }
</script>
</body>

</html>