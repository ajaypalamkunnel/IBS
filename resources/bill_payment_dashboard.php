<?php
include "header.php";
include "customer_navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bill_payment_dashboard_style.css"> <!-- Make sure to create this CSS file -->
    <script src="https://kit.fontawesome.com/8e0f91f1ba.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-description">
            <p>Manage your bill payments and transactions with ease. Your financial well-being is our priority.</p>
        </div>

        <div class="dashboard-actions">
            <div class="action-card">
                <a href="mobile_recharge.php">
                    <i class="fa-solid fa-mobile-alt fa-2x"></i>
                    <h3>Mobile Recharge</h3>
                </a>
            </div>
           
            <div class="action-card">
                <a href="electricity_payment.php">
                    <i class="fa-solid fa-bolt fa-2x"></i>
                    <h3>Electricity Bill Payment</h3>
                </a>
            </div>
        </div>
    </div>

    <!-- The rest of your code for the navigation bar can go here -->

</body>
</html>
