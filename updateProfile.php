<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['email'])) {
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];

    echo "Welcome, User ID: " . $user_id . "<br>";
    echo "Your Email: " . $email;
} else {
    echo "Please log in to access this page.";
    header("Location: loginRegister.html");
    exit;
}
?>
