<?php
session_start(); // Start the session to access session variables

include "header.php";
include "customer_navbar.php";
require("connection.php");

// Check if the session variables are set
if(isset($_SESSION['transaction_id'], $_SESSION['amount'], $_SESSION['from_account_no'], $_SESSION['to_account_no'], $_SESSION['date_issued'])) {
    $transaction_id = $_SESSION['transaction_id'];
    $amount = $_SESSION['amount'];
    $from_account_no = $_SESSION['from_account_no'];
    $to_account_no = $_SESSION['to_account_no'];
    $date_issued = $_SESSION['date_issued'];
} else {
    header("Location: transaction.php");
exit();
}

// Clear the session variables to avoid displaying the same details on page refresh
unset($_SESSION['transaction_id'], $_SESSION['amount'], $_SESSION['from_account_no'], $_SESSION['to_account_no'], $_SESSION['date_issued']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .success-message {
            background-color: #4caf50;
            color: white;
            padding: 20px;
            margin: 50px auto;
            border-radius: 5px;
            width: 80%;
            max-width: 500px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="success-message"><center>
        <h2>Transaction Successful!</h2>
        <p>Your transaction has been successfully processed.</p></center><hr>
        <p>Transaction ID: <?php echo $transaction_id; ?></p>
        <p>Amount: <?php echo $amount; ?> INR</p>
        <p>Debited Account Number: <?php echo $from_account_no; ?></p>
        <p>Receiver Account number: <?php echo $to_account_no; ?></p>
        <p>Date: <?php echo $date_issued; ?></p>
        <center><p><a href="transaction.php">Make Another Transaction</a></p></center>
    </div>
</body>
</html>
<?php
include "about.php";
?>