<?php
session_start();
if ($_SESSION["loggedin"] == "true") {
    require 'components/header.php';
    $user =  $_SESSION["username"];
    $sql = "SELECT * FROM `user` WHERE `user`.`username` = '$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>
    <div class="alert alert-success mt-4 mx-5" role="alert">
        <h4 class="alert-heading">Welcome <?php echo $row["username"] ?>!</h4>
        <p>Aww yeah, you have successfully signed up at <?php echo $site_name ?>, this important alert message for blah blahh...</p>
        <hr>
        <p class="mb-0">Your Username is <?php echo $row["username"] ?>, your email is <?php echo $row["email"] ?> and you have signed up on <?php echo $row["date"] ?> Have a nice day!</p>
    </div>
<?php
    require 'components/footer.php';
} else {
    header('Location: /login.php');
    exit();
}
?>