<?php
include "header.php";
include "user_navbar.php";
include "connection.php";



$customer_sql = "SELECT c.*, a.balance FROM customer_table c
                 LEFT JOIN accounts_table a ON c.user_id = a.user_id"; // Modify the query to join tables

$result = $conn->query($customer_sql);
if ($result === false) {
    echo "Error: " . $conn->error; // Display any database query errors
}

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/customer_list_style.css">
    <title>Customer List</title>
</head>

<body>

    <table>
        <thead>
            <tr>
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
                <th>Pin</th>
                <th>Balance</th> <!-- New column for role -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
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
                    echo "<td>{$row["pin"]}</td>";
                    echo "<td>{$row["balance"]}</td>"; // Display the role from the login_table
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>