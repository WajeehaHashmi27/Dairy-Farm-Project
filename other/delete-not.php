<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION["username"]) == false) {
    // Redirect the user to the login page or perform any other action
    header("Location: login.php");
     // Stop executing the rest of the code
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "cattlehub";
$conn = mysqli_connect($servername, $username, $password, $database);
$showAlert = false;
$showError = false;

// Assuming you have established a database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform the delete operation
    $sql = "DELETE FROM notification s WHERE Id = '$id'";
    if ($conn->query($sql) === TRUE) {
        // If the delete operation is successful, return a success message
        echo "Record deleted successfully";
    } else {
        // If an error occurs during the delete operation, return an error message
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

?>
