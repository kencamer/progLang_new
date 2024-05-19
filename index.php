<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>

</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Welcome to Dashboard</h1>
            <div>
                <a href="logout.php">Back</a>
            </div>
        </header>

        <form action="process.php" method="post">

            <div class="form-element my-4">
                <input type="text" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="firstname" placeholder="First Name:">
            </div>
            <div class="form-element my-4">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
            </div>

            <div class="form-element my-4">
                <input type="text" class="form-control" name="comment" placeholder="Comments:">
            </div>


            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="create" value="Add">
            </div>

            <!-- <a href="logout.php" class="btn btn-warning">Logout</a> -->

        </form>
    </div>

</body>

</html>