<?php
//session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();
    
    // Redirect to a login page or home page
    header("Location: login.php"); // Change 'login.php' to your desired page
    exit();
} else {
    // If the user is not logged in, redirect to a login page
    header("Location: login.php"); // Change 'login.php' to your login page
    exit();
}
?>