<?php
include "connection.php";
include "header.php";
include "user_navbar.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style/manage_customer_Style.css">
    <title>Manage Customers</title>

</head>

<body>
    <h2>Manage Customers</h2>
    <center>
        <?php
        $sql = "SELECT * FROM customer_table";
        $result = $conn->query($sql);
        ?>

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
            echo "<td><a class='button' href='edit_customer.php?id=".$row["user_id"]."'>Edit</a>  <a class='buttond' href='delete.php?id=".$row["user_id"]."'>Delete</a>  <a class='add-customer' href='add_additional_account.php.php?id=".$row["user_id"]."'>Add New Account</a>  <a class='button' href='deactivate.php?id=".$row["user_id"]."'>Deactivate</a></td>";
            //echo "<td><a class='button' href='edit_customer.php?id=" . $row["user_id"] . "'>Edit</a> <a class='buttond' href='delete.php?id=" . $row["user_id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
    }
?>
    </center>
    <br>
    <center><a class="add-customer" href="customer_add.php">Add New Customer</a></center>
    
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>

</body>

</html>