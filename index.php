<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];

    header('Location: dashboard.php');
} else {
    echo "Please log in to access this page.";
    header("Location: loginRegister.html");
    exit;
}
?>