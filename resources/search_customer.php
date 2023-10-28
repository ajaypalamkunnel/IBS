<?php
include "header.php";
include "user_navbar.php";
include("connection.php");

// Get the account number from the form
$search = $_POST['search'];

// SQL query to retrieve customer data
$search_sql = "SELECT c.*, a.* FROM customer_table c
                 LEFT JOIN accounts_table a ON c.user_id = a.user_id
                 WHERE a.account_no = '$search'";

// Execute the SQL query
$result = $conn->query($search_sql);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style/customer_profile_admin_style.css">
    <title>Customer Profile</title>
</head>

<body>
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
                $row = $result->fetch_assoc();
                echo "<h1>{$row["first_name"]} {$row["last_name"]}</h1>";
                echo "<p>Email: {$row["email_id"]}</p>";
                echo "<p>Contact: {$row["contact_no"]}</p>";
                echo "<p>Address: {$row["address"]}</p>";
                echo "<p>Branch: {$row["branch"]}</p>";
                echo "<p>Date of Birth: {$row["dob"]}</p>";
                echo "<p>PAN Card No: {$row["pan_card_no"]}</p>";
                echo "<p>Aadhar No: {$row["aadhaar_no"]}</p>";
                echo "<p>Balance: {$row["balance"]}</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
