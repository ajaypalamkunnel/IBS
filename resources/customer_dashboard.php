<?php
include "header.php";
include "customer_navbar.php";
//include "user_navbar.php"
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin_dashboard_style.css">
    <script src="https://kit.fontawesome.com/8e0f91f1ba.js" crossorigin="anonymous"></script>
</head>
<body>
    <center>
        <br><br>
        <div class="discription">
        <P>From here you can manage all of core online Banking facilities. You can perform transactions, edit details and view them. You can also see latest updates on the website.
Please remember to keep your privacy.</P>    
        </div> 

        <div class="dash_action_root">

            <div class="one">

                <a href="account_details.php">
                <i class="fa-solid fa-user fa-2xl"></i>
                    <h3>Account Details</h3>
                </a>
            </div>

            <div class="two">
                <a href="fund_transfer.php">
                <i class="fa-solid fa-money-bill-transfer fa-2xl"></i>
                    <h3>Fund transfer</h3>
                </a>
            </div>


            <div class="three">

                <a href="bill_payment_dashboard.php">
                <i class="fa-solid fa-bell fa-2xl"></i>
                    <h3>Bill Payment</h3>
                </a>
            </div>



        </div>
        <div class="dash_action_root">

            <div class="one">

                <a href="">
                <i class="fa-solid fa-clock-rotate-left fa-2xl"></i>
                    <h3>My Transaction</h3>
                </a>
            </div>


            <div class="two">
                <a href="view_balance.php">
                <i class="fa-solid fa-money-check-dollar fa-2xl"></i>
                    <h3>View Balance</h3>
                </a>
            </div>


            <div class="three">

                <a href="contact.php">
                <i class="fa-solid fa-id-card-clip fa-2xl"></i>
                    <h3>Contact us</h3>
                </a>
            </div>
        </div>
    </center>
    <br><br>
    <div style="background-color: #263238; color: white; text-align: center; padding: 10px; border-top: 3px solid #1976D2; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); overflow: hidden; white-space: nowrap; height: 30px;">
            <marquee behavior="scroll" direction="left" scrollamount="infinite">
                <span style="font-weight: none; padding-right: 20px; font-size: 20px; display: flex; align-items: center;">**<?php
            // Retrieve and display notifications from the notifications file
            $notificationFile = 'notifications.txt';

            if (file_exists($notificationFile)) {
                $notifications = file($notificationFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($notifications as $notification) {
                    echo htmlspecialchars($notification) . ' &nbsp;&nbsp;&nbsp; ';
                }
            } else {
                echo "No notifications available.";
            }
            ?>**</span>
            </marquee>
        </div>
</body>
</html>