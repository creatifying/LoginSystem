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
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    // checking if data already exixt or not
    $sql = "SELECT * FROM `user` WHERE `user`.`email` = '$email'";
    mysqli_query($conn, $sql);
    if (($conn->affected_rows) > 0) {
        $emailexist = "ture";
    } else {
        $emailexist = "false";
    }
    $sql = "SELECT * FROM `user` WHERE `user`.`username` = '$user'";
    mysqli_query($conn, $sql);
    if (($conn->affected_rows) > 0) {
        $userexist = "ture";
    } else {
        $userexist = "false";
    }
    // checking is username contains any whitespaces
    if (!(preg_match('/\s/', $user))) {
        // checking password length 
        if (strlen($pass) > 8 && strlen($pass) < 24) {
            // checking password and confirm password is same or not
            if ($pass == $cpass) {
                // checking email exists or not
                if ($emailexist == "false") {
                    // checking username exists or not
                    if ($userexist == "false") {
                        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                        // inserting data into database
                        $sql = "INSERT INTO `user` (`uid`, `email`, `username`, `password`, `date`) VALUES (NULL, '$email', '$user', '$hashed_password', current_timestamp())";
                        mysqli_query($conn, $sql);
                        $success = "true";
                    } else {
                        $error = "Username Already exists";
                    }
                } else {
                    $error = "Email Already exists";
                }
            } else {
                $error = "Password Do not match";
            }
        } else {
            $error = "Password Should be more than 8 characters, and less than 24 charaters";
        }
    } else {
        $error = "Username should not contain any Whitespaces";
    }


    // error handling
}
if ($error != "false") {
    echo '<div class="alert alert-danger" role="alert">
   ' . $error . '
  </div>';
}
if ($success == "true") {
    echo '<div class="alert alert-success" role="alert"> Signed up successfully, <a herf="/login.php"> Please login to continue.</a>
</div>';
}
?>

<form class="mx-5" action="signup.php" method="post">
    <div class="mb-2 mt-4">
        <label for="user" class="form-label">Username</label>
        <input type="text" class="form-control" id="user" name="user" aria-describedby="emailHelp" min="4" max="25">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-2 mt-4">
        <label for="user" class="form-label">Email address</label>
        <input type="email" class="form-control" id="user" name="email" aria-describedby="emailHelp">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Confirm Password</label>
        <input type="password" name="cpass" class="form-control" id="exampleInputPassword1" min="8" max="25">
    </div>

    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>

<?php
require 'components/footer.php';
?>