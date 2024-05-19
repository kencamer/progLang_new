<?php
$hostname = "localhost";
$dbUser = "root";
$dbpassword = "";
$dbname = "login-register";

$conn = mysqli_connect($hostname, $dbUser, $dbpassword, $dbname);

if (!$conn) {
    die("Something went wrong.");
}
?>