<?php
include "header.php";
include("customer_navbar.php");

// Function to convert date format
function convertDateFormat($inputDate) {
    return date('Y-m-d H:i:s', strtotime($inputDate));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <link rel="stylesheet" type="text/css" href="style/transactions_style.css"> <!-- Link to the CSS file -->
    <style>
        /* Define a CSS class for the loading animation */
        .loading {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Define a CSS class for background blur */
        .blur-background {
            filter: blur(5px); /* Adjust the blur strength as needed */
            pointer-events: none;
        }

        /* Style for the date input fields and the submit button */
        .date-input {
            display: inline-block;
            margin-right: 10px;
        }

        .submit-button {
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>Transactions</h1> <!-- Heading above the table -->

    <!-- Form for date input and download -->
    

    <form action="transactions.php" method="POST" target="_blank" id="viewForm" onsubmit="view(event)">
        <label for="startDate" class="date-input">Start Date:</label>
        <input type="date" id="startDateView" name="startDate" class="date-input">

        <label for="endDate" class="date-input">End Date:</label>
        <input type="date" id="endDateView" name="endDate" class="date-input">
        <input class="download-button submit-button" name="view" type="submit" value="View">
    </form>

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
        // View query

        require("connection.php");

        if ($conn) {
            $session_account_no = $_SESSION['account_no'];

            // Retrieve and display transactions based on user's date input
            if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
                $startDate = convertDateFormat($_POST['startDate']);
                $endDate = convertDateFormat($_POST['endDate']);

                $sql = "SELECT * FROM transaction_table 
                        WHERE from_account_no = $session_account_no
                        AND date_issued BETWEEN '$startDate' AND '$endDate'";

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
                        echo "<tr><td colspan='6'>No transactions found for this user within the selected date range.</td></tr>";
                    }
                } else {
                    echo "Query execution failed: " . mysqli_error($conn);
                }
            }

            // Close the database connection when done
            mysqli_close($conn);
        } else {
            echo "Database connection failed: " . mysqli_connect_error();
        }
        ?>
    </table>
    <form action="pdf.php" method="POST" target="_blank" id="pdfForm" onsubmit="showLoading(event)">
        <label for="startDate" class="date-input">Start Date:</label>
        <input type="date" id="startDate" name="startDate" class="date-input">

        <label for "endDate" class="date-input">End Date:</label>
        <input type="date" id="endDate" name="endDate" class="date-input">
        <input class="download-button submit-button" name="pdf_creater" type="submit" value="Download Statement">
        <div class="loading" id="loadingDiv">
            <img src="loading.gif" alt="Loading">
        </div>
    </form>
    <script>
        function showLoading(event) {
            const submitButton = event.submitter;
            if (submitButton.name === 'pdf_creater') {
                document.body.classList.add("blur-background");
                document.getElementById("loadingDiv").style.display = "block";
            }
        }

        function view(event) {
            event.preventDefault(); // Prevent the form from submitting
            const startDateView = document.getElementById("startDateView").value;
            const endDateView = document.getElementById("endDateView").value;

            // You can use the values of startDateView and endDateView to fetch and display data
            // You may use AJAX or reload the page with the view query parameters
        }
    </script>
</body>
</html>
