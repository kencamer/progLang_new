<?php
include ("database.php");

if (isset($_POST["update"])) {
    $id = $_POST["Id"];
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $comment = mysqli_real_escape_string($conn, $_POST["Comment"]);

    $sql = "UPDATE user SET email=?, first_name=?, last_name=?, Comment=? WHERE Id=?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $email, $firstname, $lastname, $comment, $id);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to dashboard or display success message
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error executing SQL statement: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error preparing SQL statement: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>