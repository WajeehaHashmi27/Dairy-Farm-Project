<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION["username"]) == false) {
    // Redirect the user to the login page or perform any other action
    header("Location: login.php");
     // Stop executing the rest of the code
}
// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header("Location: login.php");
    exit;
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
<?php
// Retrieve total number of animals
$sqlTotalAnimals = "SELECT COUNT(*) AS totalAnimals FROM animals";
$resultTotalAnimals = $conn->query($sqlTotalAnimals);
$rowTotalAnimals = $resultTotalAnimals->fetch_assoc();
$totalAnimals = $rowTotalAnimals['totalAnimals'];

// Retrieve total number of females
$sqlTotalFemales = "SELECT COUNT(*) AS totalFemales FROM animals WHERE Gender = 'Female'";
$resultTotalFemales = $conn->query($sqlTotalFemales);
$rowTotalFemales = $resultTotalFemales->fetch_assoc();
$totalFemales = $rowTotalFemales['totalFemales'];

// Retrieve total number of males
$sqlTotalMales = "SELECT COUNT(*) AS totalMales FROM animals WHERE Gender = 'Male'";
$resultTotalMales = $conn->query($sqlTotalMales);
$rowTotalMales = $resultTotalMales->fetch_assoc();
$totalMales = $rowTotalMales['totalMales'];

// Retrieve total number of pregnant animals
$sqlTotalPregnants = "SELECT COUNT(*) AS totalPregnants FROM animals WHERE Pregnant = 'Yes'";
$resultTotalPregnants = $conn->query($sqlTotalPregnants);
$rowTotalPregnants = $resultTotalPregnants->fetch_assoc();
$totalPregnants = $rowTotalPregnants['totalPregnants'];

// Close the database connection

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 13:13:41 GMT -->

<head>
    <title>Dashboard</title>


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
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
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

    <link rel="stylesheet" type="text/css" href="../files/assets/css/font-awesome-n.min.css">

    <link rel="stylesheet" href="../files/bower_components/chartist/css/chartist.css" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/widget.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
<meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
<meta name="author" content="colorlib" />

<link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">

<link rel="stylesheet" type="text/css" href="../files/assets/css/font-awesome-n.min.css">

<link rel="stylesheet" href="../files/bower_components/chartist/css/chartist.css" type="text/css" media="all">

<link rel="stylesheet" href="../files/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../files/assets/css/widget.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="colorlib" />

<link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">

<link rel="stylesheet" type="text/css" href="../files/assets/css/font-awesome-n.min.css">

<link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="../files/assets/css/widget.css">
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
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
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
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Dashboard</h5>
                                            <span>Welcome to CATTLEHUB </span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">

                                        <div class="row">

                                        <div class="col-xl-3 col-md-6">
        <div class="card prod-p-card card-red">
            <div class="card-body">
                <div class="row align-items-center m-b-30">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Total Animals</h6>
                        <h3 class="m-b-0 f-w-700 text-white"><?php echo $totalAnimals; ?></h3>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database text-c-red f-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card prod-p-card card-blue">
            <div class="card-body">
                <div class="row align-items-center m-b-30">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Total Males</h6>
                        <h3 class="m-b-0 f-w-700 text-white"><?php echo $totalMales; ?></h3>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database text-c-blue f-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card prod-p-card card-green">
            <div class="card-body">
                <div class="row align-items-center m-b-30">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Total Females</h6>
                        <h3 class="m-b-0 f-w-700 text-white"><?php echo $totalFemales; ?></h3>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database text-c-green f-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card prod-p-card card-yellow">
            <div class="card-body">
                <div class="row align-items-center m-b-30">
                    <div class="col">
                        <h6 class="m-b-5 text-white">Total Pregnant</h6>
                        <h3 class="m-b-0 f-w-700 text-white"><?php echo $totalPregnants; ?></h3>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database text-c-yellow f-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                            <div class="col-xl-4 col-md-6">
<div class="card latest-update-card">
<div class="card-header">
<h5>Groups</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option">
<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
<li><i class="feather icon-maximize full-card"></i></li>
<li><i class="feather icon-minus minimize-card"></i></li>
<li><i class="feather icon-refresh-cw reload-card"></i></li>
<li><i class="feather icon-trash close-card"></i></li>
<li><i class="feather icon-chevron-left open-card-option"></i></li>
</ul>
</div>
</div>
<div class="card-block">
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 290px;"><div class="scroll-widget" style="overflow: hidden; width: auto; height: 290px;">
<div class="latest-update-box">
<div class="row p-t-20 p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Devlopment &amp; Update</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Showcases</h6></a>
<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-success update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Miscellaneous</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-danger update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Your Manager Posted.</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Showcases</h6></a>
<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-success update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Miscellaneous</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
</div>
</div>
</div>
</div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 132px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 158.979px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>
</div>
</div>
<div class="col-xl-4 col-md-6">
<div class="card latest-update-card">
<div class="card-header">
<h5>Breed</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option">
<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
<li><i class="feather icon-maximize full-card"></i></li>
<li><i class="feather icon-minus minimize-card"></i></li>
<li><i class="feather icon-refresh-cw reload-card"></i></li>
<li><i class="feather icon-trash close-card"></i></li>
<li><i class="feather icon-chevron-left open-card-option"></i></li>
</ul>
</div>
</div>
<div class="card-block">
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 290px;"><div class="scroll-widget" style="overflow: hidden; width: auto; height: 290px;">
<div class="latest-update-box">
<div class="row p-t-20 p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Devlopment &amp; Update</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Showcases</h6></a>
<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-success update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Miscellaneous</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-danger update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Your Manager Posted.</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Showcases</h6></a>
<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-success update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Miscellaneous</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
</div>
</div>
</div>
</div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 132px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 158.979px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>
</div>
</div>
<div class="col-xl-4 col-md-6">
<div class="card latest-update-card">
<div class="card-header">
<h5>Diet Plans</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option">
<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
<li><i class="feather icon-maximize full-card"></i></li>
<li><i class="feather icon-minus minimize-card"></i></li>
<li><i class="feather icon-refresh-cw reload-card"></i></li>
<li><i class="feather icon-trash close-card"></i></li>
<li><i class="feather icon-chevron-left open-card-option"></i></li>
</ul>
</div>
</div>
<div class="card-block">
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 290px;"><div class="scroll-widget" style="overflow: hidden; width: auto; height: 290px;">
<div class="latest-update-box">
<div class="row p-t-20 p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Devlopment &amp; Update</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Showcases</h6></a>
<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-success update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Miscellaneous</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-danger update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Your Manager Posted.</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit amet, <a href="#!" class="text-c-red"> More</a></p>
</div>
</div>
<div class="row p-b-30">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-primary update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Showcases</h6></a>
<p class="text-muted m-b-0">Lorem dolor sit amet, <a href="#!" class="text-c-blue"> More</a></p>
</div>
</div>
<div class="row">
<div class="col-auto text-right update-meta p-r-0">
<i class="b-success update-icon ring"></i>
</div>
<div class="col p-l-5">
<a href="#!"><h6>Miscellaneous</h6></a>
<p class="text-muted m-b-0">Lorem ipsum dolor sit ipsum amet, <a href="#!" class="text-c-green"> More</a></p>
</div>

</div>
</div>
</div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 5px; position: absolute; top: 132px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 158.979px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>
</div>
</div>
<div class="col-xl-4 col-md-6">
<div class="card table-card">
<div class="card-header">
<h5>Milk Quantity</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option" style="width: 30px;">
<li class="first-opt complete" style=""><i class="feather open-card-option icon-chevron-left"></i></li>
<li><i class="feather icon-maximize full-card"></i></li>
<li><i class="feather icon-minus minimize-card"></i></li>
<li><i class="feather icon-refresh-cw reload-card"></i></li>
<li><i class="feather icon-trash close-card"></i></li>
<li class="complete"><i class="feather open-card-option icon-chevron-left"></i></li>
</ul>
</div>
</div>
<div class="card-block p-b-0">
<div class="table-responsive">
<table class="table table-hover m-b-0 without-header">
<tbody>
<tr>
<td>
<h4>Daily</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-warning" style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Weekly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-success"style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Monthly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-danger"style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Yearly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-primary"style = "padding:10px">4300</label>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="col-xl-4 col-md-6">
<div class="card table-card">
<div class="card-header">
<h5>Feed Amount</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option" style="width: 30px;">
<li class="first-opt complete" style=""><i class="feather open-card-option icon-chevron-left"></i></li>
<li><i class="feather icon-maximize full-card"></i></li>
<li><i class="feather icon-minus minimize-card"></i></li>
<li><i class="feather icon-refresh-cw reload-card"></i></li>
<li><i class="feather icon-trash close-card"></i></li>
<li class="complete"><i class="feather open-card-option icon-chevron-left"></i></li>
</ul>
</div>
</div>
<div class="card-block p-b-0">
<div class="table-responsive">
<table class="table table-hover m-b-0 without-header">
<tbody>
<tr>
<td>
<h4>Daily</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-warning" style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Weekly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-success"style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Monthly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-danger"style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Yearly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-primary"style = "padding:10px">4300</label>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="col-xl-4 col-md-6">
<div class="card table-card">
<div class="card-header">
<h5>Profit</h5>
<div class="card-header-right">
<ul class="list-unstyled card-option" style="width: 30px;">
<li class="first-opt complete" style=""><i class="feather open-card-option icon-chevron-left"></i></li>
<li><i class="feather icon-maximize full-card"></i></li>
<li><i class="feather icon-minus minimize-card"></i></li>
<li><i class="feather icon-refresh-cw reload-card"></i></li>
<li><i class="feather icon-trash close-card"></i></li>
<li class="complete"><i class="feather open-card-option icon-chevron-left"></i></li>
</ul>
</div>
</div>
<div class="card-block p-b-0">
<div class="table-responsive">
<table class="table table-hover m-b-0 without-header">
<tbody>
<tr>
<td>
<h4>Daily</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-warning" style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Weekly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-success"style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Monthly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-danger"style = "padding:10px">4300</label>
</td>
</tr>
<tr>
<td>
<h4>Yearly</h4></td>
<td>
<p></p>
</td>
<td class="text-right">
<label class="label label-primary"style = "padding:10px">4300</label>
</td>
</tr>
</tbody>
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

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
        </p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="../files/assets/images/browser/opera.png" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="../files/assets/images/browser/safari.png" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="../files/assets/images/browser/ie.png" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
<![endif]-->


    <script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>

    <script src="../files/assets/pages/waves/js/waves.min.js"></script>

    <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

    <script src="../files/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="../files/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="../files/assets/pages/chart/float/curvedLines.js"></script>
    <script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>

    <script src="../files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="../files/assets/pages/widget/amchart/serial.js"></script>
    <script src="../files/assets/pages/widget/amchart/light.js"></script>

    <script
        src="../../../developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="../files/assets/pages/google-maps/gmaps.js"></script>

    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="../files/assets/pages/dashboard/crm-dashboard.min.js"></script>
    <script type="text/javascript" src="../files/assets/js/script.min.js"></script>
    
<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../files/assets/pages/widget/excanvas.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

<script src="../files/assets/pages/chart/float/jquery.flot.js"></script>
<script src="../files/assets/pages/chart/float/jquery.flot.categories.js"></script>
<script src="../files/assets/pages/chart/float/curvedLines.js"></script>
<script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>

<script src="../files/assets/pages/waves/js/waves.min.js"></script>

<script src="../files/bower_components/chartist/js/chartist.js"></script>

<script type="text/javascript" src="../files/bower_components/chart.js/js/Chart.js"></script>

<script type="text/javascript" src="../files/assets/js/SmoothScroll.js"></script>

<script src="../files/assets/pages/chart/knob/jquery.knob.js"></script>

<script type="text/javascript" src="../files/assets/pages/chart/knob/knob-custom-chart.js"></script>

<script src="../files/assets/pages/widget/amchart/amcharts.js"></script>
<script src="../files/assets/pages/widget/amchart/gauge.js"></script>
<script src="../files/assets/pages/widget/amchart/serial.js"></script>
<script src="../files/assets/pages/widget/amchart/light.js"></script>
<script src="../files/assets/pages/widget/amchart/pie.min.js"></script>
<script src="../files/assets/pages/widget/amchart/ammap.min.js"></script>
<script src="../files/assets/pages/widget/amchart/usaLow.js"></script>

<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min.js"></script>

<script type="text/javascript" src="../files/assets/pages/widget/widget-chart.js"></script>
<script type="text/javascript" src="../files/assets/js/script.js"></script>
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>

<script src="../files/assets/pages/waves/js/waves.min.js"></script>

<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

<script src="../files/assets/pages/chart/float/jquery.flot.js"></script>
<script src="../files/assets/pages/chart/float/jquery.flot.categories.js"></script>
<script src="../files/assets/pages/chart/float/curvedLines.js"></script>
<script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>

<script type="text/javascript" src="../files/assets/pages/todo/todo.js"></script>

<script src="../../../developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="../files/assets/pages/google-maps/gmaps.js"></script>

<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
<script type="text/javascript" src="../files/assets/pages/widget/widget-data.js"></script>
<script type="text/javascript" src="../files/assets/js/script.min.js"></script>
    <script>
    // Display the logout success message and redirect after a delay
    function logoutSuccess() {
        alert("Logout successful");
        window.location.href = "login.php";
    }
</script>
</body>

<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 13:13:44 GMT -->

</html>