<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cattlehub";
$conn = mysqli_connect($servername, $username, $password, $database);
$showAlert = false;
$showError = false;
if (isset($_POST['btn'])) {
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  $sql = "SELECT * FROM `login` WHERE `userName` = '$user' AND `Password` = '$pass'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $showAlert = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user;
    header("Location: dashboard-crm.php");
  } else {
    $showError = "Invalid Credentials";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Bootstrap link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
</head>

<body>


  <nav class="navbar bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="./logo.png" alt="Bootstrap" width="200px">
      </a>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="d-flex align-items-center h-100">
          <div class="w-100">
            <h3 class="mb-4">Login form</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <?php if ($showError) : ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $showError; ?>
                </div>
              <?php endif; ?>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="user" class="form-control" required placeholder="Enter username">
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" required placeholder="Enter Password">
              </div>
              <div class="mb-3">
                <button type="submit" name="btn" class="btn btn-primary">Login</button>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex align-items-center justify-content-center vh-full" style="background-image: url('./side_image.jpg'); background-size: cover; background-position: center;">

        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Bootstrap JS link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>