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
        <!-- <h2>Hi Welcome Admin!!</h2>
        <div class="discription">
        <P>From here you can manage all of core online Banking settings. You can add/manage customers, view their transactions, edit their details and even delete them. You can also post news on the website.
Please keep in mind that with big power comes big responsibility. Therefore please do not misuse your admin control to create trouble.</P>    
            
            
        </div> -->
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

                <a href="">
                <i class="fa-solid fa-bell fa-2xl"></i>
                    <h3>Notifications</h3>
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

                <a href="">
                <i class="fa-solid fa-id-card-clip fa-2xl"></i>
                    <h3>Contact us</h3>
                </a>
            </div>




        </div>

    </center>
</body>
</html>