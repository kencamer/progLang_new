<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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

    <title>User Details</title>
    <style>
        .user-details {
            background-color: #f5f5f5;
            padding: 50px;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>User Details</h1>
            <div>
                <a href="dashboard.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="user-details my-4">
            <?php
            include ("database.php");
            if (isset($_GET["Id"])) {
                $id = filter_var($_GET["Id"], FILTER_VALIDATE_INT);

                if ($id === false || $id === null) {
                    echo "<h3>Invalid ID</h3>";
                } else {
                    $sql = "SELECT * FROM user WHERE Id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <h2>Email</h2>
                        <p><?php echo htmlspecialchars($row["email"]); ?></p>
                        <h2>First Name</h2>
                        <p><?php echo htmlspecialchars($row["first_name"]); ?></p>
                        <h2>Last Name</h2>
                        <p><?php echo htmlspecialchars($row["last_name"]); ?></p>
                        <h2>Comment</h2>
                        <p><?php echo htmlspecialchars($row["Comment"]); ?></p>
                        <?php
                    } else {
                        echo "<h3>No Info Found</h3>";
                    }
                    mysqli_stmt_close($stmt);
                }
            } else {
                echo "<h3>No ID Found</h3>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>

</html>