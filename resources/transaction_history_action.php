<?php
include "header.php";
include "customer_navbar.php";
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $account_no = $_POST['accountNo']; // Corrected the array key
    $pin = $_POST['pin'];
    $user_id = $_SESSION['user_id'];

    // Verify the entered account_no and PIN
    $stmt = $conn->prepare("SELECT c.*, a.* FROM customer_table c
    LEFT JOIN accounts_table a ON c.user_id = a.user_id WHERE a.user_id = ? AND account_no = ? AND pin = ?");
    
    // Check if prepare() succeeded
    if ($stmt === false) {
        die("Error in SQL statement: " . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("iss", $user_id, $account_no, $pin);
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Account number and PIN verified, fetch transaction history
            $transaction_stmt = $conn->prepare("SELECT * FROM transaction_table WHERE from_account_no = ?");
            
            // Check if prepare() succeeded
            if ($transaction_stmt === false) {
                die("Error in SQL statement: " . $conn->error);
            }

            // Bind parameters and execute the query
            $transaction_stmt->bind_param("s", $account_no);
            if ($transaction_stmt->execute()) {
                $transaction_result = $transaction_stmt->get_result();

                // Process transaction history data
                while ($row = $transaction_result->fetch_assoc()) {
                    // Process each transaction record as needed with CSS styling
                    echo "<div class='transactionRecord'>
                            <span class='transactionID'>Transaction ID: " . $row["transaction_id"] . "</span><br><br>
                            <span class='transactionAmount'>Amount: $" . $row["amount"] . "</span>
                            <span class='transactionAmount'>Receiver account number: " . $row["to_account_no"] . "</span>
                            <span class='transactionAmount'>Transaction type: " . $row["transaction_type"] . "</span>
                            <span class='transactionAmount'>Date of transaction: $" . $row["date_issued"] . "</span>
                          </div>";
                }
            } else {
                // Error in executing transaction statement
                die("Error in executing transaction statement: " . $transaction_stmt->error);
            }
        } else {
            // Account number or PIN verification failed
            echo "<div class='error'>Invalid account number or PIN.</div>";
        }
    } else {
        // Error in executing statement
        die("Error in executing statement: " . $stmt->error);
    }

    // Close the statements
    $stmt->close();
    $transaction_stmt->close();
}
?>

<html>
    <head>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
}

.container {
    margin: 0 auto;
    text-align: center;
    margin-top: 50px;
    max-width: 100px;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.transactionRecord {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: left;
}

.transactionAmount {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.transactionID {
    color: #4CAF50;
    font-size: 18px;
    margin-bottom: 10px;
}

.error {
    color: #ff4545;
    margin-top: 10px;
    font-weight: bold;
}

</style>

</head>
    <body>
     
</body>
</html>