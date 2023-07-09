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
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $name = $_POST['userName'];
    $age = $_POST['email'];
    $gender = $_POST['gender'];
    $temperature = $_POST['temperature'];
    $price = $_POST['price'];
    $pregnant = $_POST['pregnant'];
    $breed = $_POST['breed'];

    // Perform your update query here to update the record in the database based on the given ID

    // Example update query
    $updateQuery = "UPDATE animals SET Name = '$name', Age = '$age', Gender = '$gender', Temperature = '$temperature', Price = '$price', Pregnant = '$pregnant', Breed = '$breed' WHERE Id = $id";
    
    // Execute the update query
    if (mysqli_query($conn, $updateQuery)) {

        header("Location: list-animal.php");
        echo "Record updated successfully";
    } else {
        header("Location: new_page.php");
    }
}

    ?>
    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.dashboardpack.com/admindek-html/default/dashboard-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 13:13:41 GMT -->

<head>
    <title>Update</title>
</head>

<body>


</body>

</html>