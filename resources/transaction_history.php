<?php
include "header.php";
include "customer_navbar.php";
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
        .container {
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
            max-width: 400px;
            margin-bottom: 250px;
        }

        input[type="text"],
        input[type="password"] {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Enter Account Number and PIN</h2>
        <form id="transactionForm" method="POST" action="transaction_history_action.php">
            <label for="accountNo">Account Number:</label>
            <input type="text" id="accountNo" name="accountNo" required><br>
            <label for="pin">PIN:</label>
            <input type="password" id="pin" name="pin" required><br>
            <input type="submit" value="Get Transaction History">
        </form>
    </div>
</body>

</html>
<?php
include("about.php");
?>
