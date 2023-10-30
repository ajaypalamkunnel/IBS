<?php
     include "connection.php";
     include "header.php";
     include "user_navbar.php";
     ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<font Color="Purple">
    <center><h2 style="font-size:40px;">Manage Customers</h2></center>

    <?php
    $sql = "SELECT * FROM customer_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Actions</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["user_id"]."</td>";
            echo "<td>".$row["first_name"]."</td>";
            echo "<td>".$row["last_name"]."</td>";
            echo "<td><a href='edit_customer.php?id=".$row["user_id"]."'>Edit</a> | <a href='delete.php?id=".$row["user_id"]."'>Delete</a> | <a href='add_additional_account.php.php?id=".$row["user_id"]."'>Add New Account</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No customers found.";
    }

    ?>
</font>
    <br>
    <a href="customer_add.php">Add New Customer</a>
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>

</body>
</html>
