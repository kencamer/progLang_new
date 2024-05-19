<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatpassword = $_POST["repeat_password"];
            $errors = array();

            // Hash the password
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);

            // Validate form inputs
            if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($repeatpassword)) {
                array_push($errors, "All fields are required.");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid.");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long.");
            }
            if ($password !== $repeatpassword) {
                array_push($errors, "Passwords do not match.");
            }

            require_once "database.php";
            // Check if email already exists
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {
                    array_push($errors, "Email already exists.");
                }
            } else {
                array_push($errors, "Database query error: " . mysqli_error($conn));
            }

            // Display errors or register the user
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $passwordhash);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>You are registered successfully.</div>";
                    } else {
                        echo "SQL error: " . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "SQL error: " . mysqli_stmt_error($stmt);
                }
            }
        }
        ?>
        <form action="registration2.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit" value="Register">
            </div>
        </form>
        <div>
            <?php
            if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'login.php') !== false) {
                echo '<p>Already Registered? <a href="login.php">Login Here</a></p>';
            } else {
                echo '<p>Already Registered? <a href="login.php">Login Here</a></p>';
            }
            ?>


        </div>
    </div>
</body>

</html>