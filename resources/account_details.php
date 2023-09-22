<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/account_details_style.css">
    <title>Customer Details</title>
</head>
<body>
    <?php
     include "connection.php";
     include "customer_navbar.php";?>
    <div class="container">
        <?php
       

        // Replace this with the customer ID or another identifier
        $customer_id = $_SESSION['user_id']; // Example: You may fetch the customer ID from a URL parameter or another source

        // Replace this with your SQL query to fetch customer details
        $sql = "SELECT first_name, last_name, contact_no, address, branch FROM customer_table WHERE user_id = '$customer_id'";
        $sql2 = "SELECT account_no, balance FROM accounts_table WHERE user_id = '$customer_id'";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        // Check if the query executed successfully
        if (!$result && $result2) {
            die("Error: " . mysqli_error($conn));
        }

        $row_count = mysqli_num_rows($result);
        $row_count2 = mysqli_num_rows($result2);

        if ($row_count && $row_count2 > 0) {
            $row = mysqli_fetch_assoc($result);
            $row2 = mysqli_fetch_assoc($result2);
            ?>
            <h1>Customer Details</h1>
            <div class="customer-details">
                <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
                <p><strong>Account Number:</strong> <?php echo $row2['account_no']; ?></p>
                <p><strong>Mobile:</strong> <?php echo $row['contact_no']; ?></p>
                <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                <p><strong>Balance:</strong> <?php echo $row2['balance']; ?></p>
                <p><strong>Branch:</strong> <?php echo $row['branch']; ?></p>
                <p><strong>Account Type:</strong> <?php echo "account type"; ?></p>
            </div>
            <?php
        } else {
            echo "<p>No customer details found</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>