<?php
session_start();

if (isset($_GET['Id'])) {
    include ("database.php");
    $id = $_GET['Id'];
    $sql = "DELETE FROM user WHERE Id='$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["delete"] = "User Deleted Successfully!";
        header("Location: dashboard.php");
        exit();
    } else {
        die("Something went wrong");
    }
} else {
    echo "User does not exist";
}
?>