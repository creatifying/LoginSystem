<?php

// connecting to the database
$server = "localhost";
$username = "root";
$password = "";
$dbname = "loginform";

$conn = mysqli_connect($server , $username , $password , $dbname);
if(mysqli_connect_errno($conn)){
    echo "Unknowm error occured ".mysqli_connect_error();
}

// Site configration
$site_name = "Creatifying";
$site_title = "Creatifying";


?>