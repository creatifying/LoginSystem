<?php
session_start();
if (isset($_SESSION["loggedin"])) {
  header('Location: /dash.php');
  exit();
}
require 'components/header.php';

$error = "false";
$success = "false";
// checking post data
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
  // fetching user from database
  $sql = "SELECT * FROM `user` WHERE `user`.`username` = '$user'";
  $result = mysqli_query($conn, $sql);
  // checking username exists or not
  if (!mysqli_affected_rows($conn) == 1) {
    $error = "Username or Email do not exist";
    $_SESSION["loggedin"] = "false";
  } else {
    $row = mysqli_fetch_assoc($result);
    $hasshed = $row['password'];
    if (password_verify($pass, $hasshed)) {
      echo "Logged in successfully";
      // creating user session
      $_SESSION["loggedin"] = "true";
      $_SESSION["username"] = $row['username'];
      $_SESSION["email"] = $row['email'];
      // redirecting to dashboard
      header('Location: /dash.php');
    } else {
      $error = "Incorrect Password";
    }
  }
}


// error handling
if ($error != "false") {
  echo '<div class="alert alert-danger" role="alert">
 ' . $error . '
</div>';
}


?>

<form class="mx-5" action="login.php" method="post">
  <div class="mb-2 mt-4">
    <label for="user" class="form-label">Username</label>
    <input type="text" class="form-control" id="user" name="user" aria-describedby="emailHelp">
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="mb-3">
    <label for="pass" class="form-label">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary">Sign in</button>
</form>

<?php
require 'components/footer.php';
?>