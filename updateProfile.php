<?php
session_start();
require_once 'partials/database.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $sql = "UPDATE login_cred SET first_name = ?, last_name = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters to the query
        mysqli_stmt_bind_param($stmt, "sss", $fname, $lname, $user_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('User information updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update user information.');</script>";
        }
    } else {
        echo "Failed to prepare the statement.";
    }


    header('Location: dashboard.html');
} else {
    echo "Please log in to access this page.";
    header("Location: loginRegister.html");
    exit;
}
?>