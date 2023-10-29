<?php
session_start(); // Start the session

require("connection.php"); // Assuming you have a valid database connection here

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $logout_time = date("Y-m-d H:i:s");

    $update_sql = "UPDATE `access_table` SET logout_time=? WHERE user_id=?";
    $stmtt = mysqli_prepare($conn, $update_sql);
    
    if ($stmtt) {
        mysqli_stmt_bind_param($stmtt, "ss", $logout_time, $_SESSION['user_id']);
        if (mysqli_stmt_execute($stmtt)) {
            // Logout time updated successfully
        } else {
            // Handle the execution error
            die("Error in executing SQL statement: " . mysqli_error($conn));
        }
    
        mysqli_stmt_close($stmtt);
    } else {
        // Handle the SQL statement preparation error
        die("Error in SQL statement: " . mysqli_error($conn));
    }
    
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
