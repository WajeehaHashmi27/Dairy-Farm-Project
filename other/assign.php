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


// Check if the ID is submitted via POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Store the ID in a session variable
    $_SESSION['selected_id'] = $id;

    // Redirect to the assign.php page
    header('Location: assign.php');
    exit;
}

if (isset($_POST['finish'])) {
    $date = $_POST["date"];
    $quantity = $_POST["Q"];
    $cost = $_POST["TotalCost"];
    $d_id = $_POST["dietplan_id"];
    $a_id = $_POST["animal_id"];
    $sql = "INSERT INTO `animals_dietplan` (`a_id`, `d_id`, `date`, `quantity`, `cost`) VALUES ('$a_id', '$d_id', '$date', '$quantity', '$cost')";
    $result = mysqli_query($conn, $sql);

    $sql2 = "UPDATE `animals` SET `Diet plan` = '$d_id', `Date` = $date, Quantity = $quantity, Cost = $cost WHERE `animals`.`Id` = '$a_id'";
    $result2 = mysqli_query($conn, $sql2);

    $formattedDate = date("Y-m-d H:i:s", strtotime($date));
    // Generate notification message
    $notificationMessage = "Animal with name has been assigned diet plan";
    $status = "unread";
    // Insert notification into the notification table
    $notificationSql = "INSERT INTO notifications (content, status, timestamp) VALUES ('$notificationMessage', '$status', NOW())";
    $conn->query($notificationSql);
}

// Check if the selected ID is stored in the session

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

<?php

// Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get form data
//     $d_id = $_POST['dietplan_id'];
//     $a_id = $_POST['id'];
//     $date = $_POST['date'];
//     $quantity = $_POST['Q'];
//     $cost = $_POST['TotalCost'];

//     echo $d_id;
//     echo $a_id;
//     echo $date;
//     echo $quantity;
//     echo $cost;
// }

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 13:13:41 GMT -->

<head>
    <title>Assign Diet Plan</title>


    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="colorlib" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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




                    <div class="pcoded-content">
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-edit bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Assign Diet Plan</h5>
                                            <span>Assign new Diet plan to Animals</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class="breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item">

                                                <a href="dashboard-crm.php"><i class="feather icon-home"></i></a>

                                            </li>
                                            <li class="breadcrumb-item" style="font-size:14px">
                                                Diet Plan
                                            </li>
                                            <li class="breadcrumb-item" style="font-size:14px">
                                                Assign Diet Plan
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
                                                        <h5>Assign Diet Plan </h5>
                                                        <span>Add class of <code>.form-control</code> with
                                                            <code>&lt;input&gt;</code> tag</span>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div id="wizard">
                                                                    <section>
                                                                        <form class="wizard-form" id="example-advanced-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                                            <h3> Select Diet Plan </h3>
                                                                            <input type="hidden" name="animal_id" value="<?php echo $_SESSION['selected_id'] || ""; ?>">
                                                                            <fieldset>
                                                                                <div class="col-md-6 col-lg-4">
                                                                                    <div class="card text-white card-primary" style="width :870px">

                                                                                        <div class="card-body">
                                                                                            <?php

                                                                                            if (isset($_SESSION['selected_id'])) {
                                                                                                $id = $_SESSION['selected_id'];

                                                                                                // Fetch the details of the respective ID from the database
                                                                                                // Perform your database query here using the $id variable

                                                                                                // Example query to retrieve details based on the ID
                                                                                                $query = "SELECT * FROM animals WHERE Id = " . $id;
                                                                                                $result = mysqli_query($conn, $query);

                                                                                                // Check if the query was successful and fetch the data
                                                                                                if ($result && $result->num_rows > 0) {
                                                                                                    $row = $result->fetch_assoc();

                                                                                                    // Display the details
                                                                                                    echo "<div style='display: flex;'>";
                                                                                                    echo "<h5 style='margin-right: 80px;'>Id: " . $row['Id'] . "</h5>";
                                                                                                    echo "<h5 style='margin-right: 80px;'>Name: " . $row['Name'] . "</h5>";
                                                                                                    echo "<h5 style='margin-right: 80px;'>Gender: " . $row['Gender'] . "</h5>";
                                                                                                    echo "<h5>Age: " . $row['Age'] . "</h5>";
                                                                                                    echo "</div>";

                                                                                                    echo "<div style='display: flex;'>";

                                                                                                    echo "<h5 style='margin-right: 80px;'>Temperature: " . $row['Temperature'] . "</h5>";
                                                                                                    echo "<h5 style='margin-right: 80px; float:right'>Pregnant: " . $row['Pregnant'] . "</h5>";
                                                                                                    echo "<h5 >Price: " . $row['Price'] . "</h5>";
                                                                                                    echo "</div>";

                                                                                                    echo "<div style='display: flex;'>";

                                                                                                    echo "<h5 style='margin-right: 80px;'>Breed: " . $row['Breed'] . "</h5>";
                                                                                                    echo "<h5 style='margin-right: 80px;'>Diet plan: " . $row['Diet plan'] . "</h5>";
                                                                                                    echo "<h5>Milk production: " . $row['milk production'] . "</h5>";
                                                                                                    echo "</div>";
                                                                                                } else {
                                                                                                    echo "No record found for ID: " . $id;
                                                                                                }

                                                                                                // Clear the selected ID from the session
                                                                                                unset($_SESSION['selected_id']);
                                                                                            } else {
                                                                                                echo "No ID selected.";
                                                                                            }
                                                                                            ?>
                                                                                        </div>

                                                                                    </div>




                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-12 col-lg-12">
                                                                                            <label for="password-2" class="blockstyle" style="padding-right: 80px;">Diet plans:</label>
                                                                                        </div>
                                                                                        <div class="col-md-30 col-lg-30">
                                                                                            <?php
                                                                                            // Assuming you have established a database connection
                                                                                            $sql = "SELECT * FROM dietplan"; // Query to fetch options from the database
                                                                                            $result = $conn->query($sql);

                                                                                            if ($result->num_rows > 0) {
                                                                                                while ($row = $result->fetch_assoc()) {
                                                                                                    $cost = $row['Cost'];
                                                                                                    $option = ' ' . $row['Milkproduction'] . ' Milk, ' . $row['Name'] . '(Name), ' . $row['Foarges'] . ' ' . $row['FQuantity'] . ' kg, ' . $row['Proteins'] . ' ' . $row['PQuantity'] . ' kg, ' . $row['Minvit'] . ' ' . $row['MQuantity'] . ' kg, ' . $row['Cost'] . ' Rs';

                                                                                                    echo '<div class="radio radio-inline" style="width:1000px;padding-left:80px">';
                                                                                                    echo '<label>';
                                                                                                    echo '<input type="radio" style="display: inline; " name="dietplan_id" value="' . $row['Id'] . '" onclick="updateCost(' . $cost . ')">';
                                                                                                    echo $option;
                                                                                                    echo '</label>';
                                                                                                    echo '</div>';
                                                                                                    echo '<br>';

                                                                                                    if (isset($_POST['dietplan_id']) && $_POST['dietplan_id'] == $row['Id']) {
                                                                                                        $selectedOption = $option;
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row  ">


                                                                            </fieldset>
                                                                            <h3> Basic information </h3>
                                                                            <fieldset>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="userName-2" class="block">Date
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input class="form-control" type="date" name="date" id="date">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="Company-2" class="block">Quantity:</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="q" name="Q" type="number" class="form-control required" value="0" onchange="calculateTotalCost()">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <div class="col-md-4 col-lg-2">
                                                                                        <label for="Company-2" class="block">Total Cost:</label>
                                                                                    </div>
                                                                                    <div class="col-md-8 col-lg-10">
                                                                                        <input id="total-cost" name="TotalCost" type="number" class="form-control" readonly>
                                                                                    </div>
                                                                                </div>


                                                                                <button style="margin-left: 850px; margin-top: 40px" type="submit" class="btn btn-primary waves-effect waves-light" name="finish" id="primary-popover-content" data-container="body" data-toggle="popover" title="Primary color states" data-placement="bottom" data-content="<div class='color-code'>
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

                      ">
                                                                                    Finish
                                                                                </button> <!-- Finish button -->




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

            <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

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
                var selectedCost;

                function updateCost(cost) {
                    selectedCost = cost;
                }
                document.getElementById('q').addEventListener('input', calculateTotalCost);

                function calculateTotalCost() {
                    var quantity = document.getElementById('q').value;
                    var totalCost = quantity * selectedCost;
                    document.getElementById('total-cost').value = totalCost.toFixed(2);
                }
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