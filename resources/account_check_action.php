<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/customer_profile_admin_style.css">
    <title>Customer Details</title>
</head>

<body>

    <?php
    include "connection.php";
    include "header.php";
    include "customer_navbar.php";
    $acc_status = $_SESSION['account_status'];

    $account_no = $_POST['accountNo']; // Corrected the array key
    $pin = $_POST['pin'];
    $user_id = $_SESSION['user_id'];

    $customer_id = $_SESSION['user_id'];

    $search_sql = "SELECT c.*, a.* FROM customer_table c
                 LEFT JOIN accounts_table a ON c.user_id = a.user_id
                 WHERE c.user_id = '$customer_id'";

    // Execute the SQL query
    $result = $conn->query($search_sql);
    $row = $result->fetch_assoc();

    if ($row["pin"] == $pin) {

        ?>
        <div class="profile-container">
            <div class="profile-avatar">
                <?php
                if ($result === false) {
                    echo '<p class="error-message">Error: ' . $conn->error . '</p>';
                } else if ($result->num_rows > 0) {
                    // Data retrieved successfully, display the profile image
                    echo '<img src="images/logo.png" alt="Customer Avatar">';
                } else {
                    // No data found for the provided account number
                    echo '<p class="error-message">No customer found for the provided account number.</p>';
                }
                ?>
            </div>
            <div class="profile-info">
                <?php
                // Check if there are results
                if ($result !== false && $result->num_rows > 0) {
                    // Fetch the data and display it
                    
                   
                        // Your existing code to display user data
                        echo "<h1>{$row["first_name"]} {$row["last_name"]}</h1>";
                       // echo "<p>Email: {$row["email_id"]}</p>";
                       // echo "<p>Contact: {$row["contact_no"]}</p>";
                      //  echo "<p>Address: {$row["address"]}</p>";
                      echo "<p>Account NO: {$row["account_no"]}</p>";
                        echo "<p>Branch: {$row["branch"]}</p>";
                        echo "<p>Date of Birth: {$row["dob"]}</p>";
                        echo "<p>Account type: {$row["account_type"]}</p>";
                        echo "<p>PAN Card No: {$row["pan_card_no"]}</p>";
                        echo "<p>Aadhar No: {$row["aadhaar_no"]}</p>";
                        echo "<p>Account status: {$row["account_status"]}</p>";
                        echo "<p>Balance: {$row["balance"]}</p>";
                    


                }
                ?>

            </div>
            <?php
    } else {
        echo '<script>alert("Invalid Account."); window.location = "account_check.php";</script>';
    }

    ?>
    </div>
</body>

</html>
<?php
include "about.php";

?>