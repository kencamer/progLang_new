<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginForm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            require_once "database.php";

            // Check if email and password fields are not empty
            if (empty($email) || empty($password)) {
                echo "<div class='alert alert-danger'>Email and Password are required.</div>";
            } else {
                $sql = "SELECT * FROM user WHERE email = ?";
                $stmt = mysqli_prepare($conn, $sql);

                // Check if statement preparation was successful
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    // Fetch the user data
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if ($user) {
                        // Verify the password
                        if (password_verify($password, $user["password"])) {
                            session_start();
                            $_SESSION["user"] = $user["id"]; // Save user ID in session
        
                            header("Location: dashboard.php");
                            die();
                        } else {
                            echo "<div class='alert alert-danger'>Password does not match</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Database query failed: " . mysqli_error($conn) . "</div>";
                }
            }
        }
        ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" placeholder="Enter Password:" name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p>Not registered yet? <a href="registration2.php">Register Here</a></p>
        </div>
    </div>

</body>

</html>