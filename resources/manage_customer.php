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
            echo "<td><a href='edit.php?id=".$row["user_id"]."'>Edit</a> | <a href='delete.php?id=".$row["user_id"]."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No customers found.";
    }

    $conn->close();
    ?>
</font>
    <br>
    <a href="add_customer.php">Add New Customer</a>
</body>
</html>