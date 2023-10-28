<?php
include "header.php";
include("customer_navbar.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <link rel="stylesheet" type="text/css" href="style/transactions_style.css"> <!-- Link to the CSS file -->
</head>
<body>
    <h1>Transactions</h1> <!-- Heading above the table -->

    <table class="transaction-table">
        <tr>
            <th>Transaction ID</th>
            <th>Transaction Type</th>
            <th>From Account No</th>
            <th>To Account No</th>
            <th>Date Issued</th>
            <th>Amount</th>
        </tr>

        <?php
        require("connection.php");

        if ($conn) {
            $session_account_no = $_SESSION['account_no'];
            echo "\nuser: " . $session_account_no;

            $sql = "SELECT * FROM transaction_table WHERE from_account_no =  $session_account_no";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["transaction_id"] . "</td>";
                        echo "<td>" . $row["transcation_type"] . "</td>";
                        echo "<td>" . $row["from_account_no"] . "</td>";
                        echo "<td>" . $row["to_account_no"] . "</td>";
                        echo "<td>" . $row["date_issued"] . "</td>";
                        echo "<td>" . $row["amount"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No transactions found for this user.</td></tr>";
                }
            } else {
                echo "Query execution failed: " . mysqli_error($conn);
            }

            // Close the database connection when done
            mysqli_close($conn);
        } else {
            echo "Database connection failed: " . mysqli_connect_error();
        }
        ?>
    </table>
<form action="pdf.php" method="POST" target="_blank">
    <input class="download-button" name="pdf_creater" type="submit" value="Download Statement">
<!-- <a href="download_statement.php" class="download-button">Download Statement</a> -->
</form>
    
</body>
</html>
