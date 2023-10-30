<?php
include "header.php";
include "user_navbar.php";
include "connection.php";

$customer_sql = "SELECT c.*, a.balance, a.account_no FROM customer_table c
                 LEFT JOIN accounts_table a ON c.user_id = a.user_id"; // Modify the query to join tables

$result = $conn->query($customer_sql);
if ($result === false) {
    echo "Error: " . $conn->error; // Display any database query errors
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/customer_list_style.css">
    <title>Customer List</title>
    <style>
        .search-container {
            text-align: center;
            margin-top: 20px;
        }

        .search-input {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #263238;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #1a1a1a;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

</head>

<body>

    <div class="search-container">
        <form method="POST" action="search_customer.php">
            <input type="number" class="search-input" name="search" placeholder="Search by account number">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Acc No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Pan Card No</th>
                <th>Aadhar No</th>
                <th>Branch</th>
                <th>Join Date & time</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row["account_no"]}</td>";
                    echo "<td>{$row["first_name"]}</td>";
                    echo "<td>{$row["last_name"]}</td>";
                    echo "<td>{$row["address"]}</td>";
                    echo "<td>{$row["contact_no"]}</td>";
                    echo "<td>{$row["email_id"]}</td>";
                    echo "<td>{$row["gender"]}</td>";
                    echo "<td>{$row["dob"]}</td>";
                    echo "<td>{$row["pan_card_no"]}</td>";
                    echo "<td>{$row["aadhaar_no"]}</td>";
                    echo "<td>{$row["branch"]}</td>";
                    echo "<td>{$row["join_date"]}</td>";
                    echo "<td>{$row["balance"]}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>

</body>

</html>