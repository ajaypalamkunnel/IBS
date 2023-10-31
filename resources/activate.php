<?php
include "connection.php";
 if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    //echo 'user:  '.$user_id.'';

     // SQL query to update the account status
     $sql = "UPDATE accounts_table SET account_status = 'Active' WHERE user_id = '$user_id'";

     // Execute the query
     if ($conn->query($sql) === TRUE) {
         echo" <script>alert( 'Account Activated successfully.');</script>";
     } else {
         echo "Error updating account status: " . $conn->error;
         
     }
 }else
{
    echo" <script>alert( $accountNumber.'Activation Failed');</script>";
} 
 // Close the database connection
 $conn->close();
 
?>