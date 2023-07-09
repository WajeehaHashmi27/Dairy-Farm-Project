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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-status'])) {
    // Get the notification ID from the form
    $notificationId = $_POST['id'];

    // Update the status in the database
    $updateSql = "UPDATE notifications SET Status = 'read' WHERE Id = $notificationId";

    if ($conn->query($updateSql) === TRUE) {
        // Set success message in session
        $_SESSION['success_message'] = "Record updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error updating status: " . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Redirect back to the original page
header("Location: not-details.php");
exit;


// Close the database connection
$conn->close();

?>