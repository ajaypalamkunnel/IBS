<?php
include "header.php";
include "customer_navbar.php";
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $account_no = $_POST['accountNo']; // Corrected the array key
    $pin = $_POST['pin'];
    $user_id = $_SESSION['user_id'];

    // Verify if the entered account_no belongs to the logged-in user_id
    $account_check_stmt = $conn->prepare("SELECT * FROM accounts_table WHERE user_id = ? AND account_no = ?");
    $account_check_stmt->bind_param("is", $user_id, $account_no);
    $account_check_stmt->execute();
    $account_check_result = $account_check_stmt->get_result();

    if ($account_check_result->num_rows === 0) {
        echo "<div class='error'>Invalid account number.</div>";
    } else {
        // Verify the entered account_no and PIN
        $stmt = $conn->prepare("SELECT c.*, a.* FROM customer_table c
        LEFT JOIN accounts_table a ON c.user_id = a.user_id WHERE a.user_id = ? AND a.account_no = ? AND c.pin = ?");

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

                    if ($transaction_result->num_rows === 0) {
                        echo "<div class='error'>No transaction to show.</div>";
                    } else {
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
                    }
                } else {
                    // Error in executing transaction statement
                    echo "<div class='error'>Error in executing transaction statement.</div>";
                }

                // Close the transaction statement if it's initialized
                $transaction_stmt->close();
            } else {
                // Account number or PIN verification failed
                echo "<div class='error'>Invalid PIN.</div>";
            }
        } else {
            // Error in executing statement
            echo "<div class='error'>Error in executing statement.</div>";
        }

        // Close the main statement if it's initialized
        $stmt->close();
    }

    // Close the account check statement
    $account_check_stmt->close();
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
            font-size: 24px;
            /* Adjust the font size to your preference */
            text-align: center;
            /* Align the text to the center */
        }

        .back-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .download-button {
            width: 150px;
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .download-button:hover {
            background-color: #555;
        }
    </style>

</head>

<body>

    <a href="transaction_history.php" class="back-button">Back</a>
    <center>
        <form id="reportForm" action="pdf.php" method="post">
        <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>
                <input type="submit" class="download-button submit-button" value="Download">
        </form>
        
    </center>
    <?php
include "about.php";
?>
</body>

</html>