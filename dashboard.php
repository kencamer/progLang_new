<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>User List</title>

    <style>
        body {
            padding: 20px;
            background: url(bg.jpg);
        }

        .container {
            max-width: 800px;
        }

        .btn-group {
            margin-bottom: 20px;
        }

        table {
            margin-top: 20px;

        }
    </style>

</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>User List</h1>
            <div>
                <a href="registration.php" class="btn btn-primary">Add User</a>
                <a href="logout.php" class="btn btn-danger">Exit</a>
            </div>

        </header>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Comment</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php
                include ('database.php');
                $sqlSelect = "SELECT * FROM user";
                $result = mysqli_query($conn, $sqlSelect);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['Comment']; ?></td>
                        <td>

                            <a href="view.php?Id=<?php echo $row['id']; ?>" class="btn btn-info">Read More</a>
                            <a href="edit.php?Id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?Id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>



                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>
    </div>

</body>

</html>