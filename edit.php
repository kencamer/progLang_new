<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Edit User</title>
</head>

<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit User</h1>
            <div>
                <a href="dashboard.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <?php
            if (isset($_GET['Id'])) {
                include ("database.php");
                $id = $_GET['Id'];
                $sql = "SELECT * FROM user WHERE Id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                ?>

                <div class="form-element my-4">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" placeholder="Email:"
                        value="<?php echo $row["email"]; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="first_name" placeholder="First Name:"
                        value="<?php echo $row["first_name"]; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name:"
                        value="<?php echo $row["last_name"]; ?>">
                </div>

                <div class="form-element my-4">
                    <label for="Comment">Comment:</label>
                    <textarea name="Comment" class="form-control"
                        placeholder="Comment"><?php echo $row["Comment"]; ?></textarea>
                </div>


                <input type="hidden" name="Id" value="<?php echo $id; ?>">

                <div class="form-element my-4">
                    <input type="submit" name="update" value="Update User" class="btn btn-primary">
                </div>

                <?php
            } else {
                echo "<h3>User Does Not Exist</h3>";
            }
            ?>
        </form>
    </div>
</body>

</html>