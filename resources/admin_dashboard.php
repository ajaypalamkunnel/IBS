<?php
include "header.php";
include "user_navbar.php"

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin_dashboard_style.css">
    <script src="https://kit.fontawesome.com/8e0f91f1ba.js" crossorigin="anonymous"></script>

</head>

<body>
    <center>
        <h2>Hi, Welcome to IBS Staff Administrator Dashboard!!</h2>
        <div class="discription">
        <P>From here you can manage all of core Internet Banking settings. You can add/manage customers, view their transactions, edit their details and even delete them. You can also post news on the website.
Please keep in mind that with big power comes big responsibility. Therefore please do not misuse your admin control to create trouble.</P>    
            
            
        </div>
        <div class="dash_action_root">

            <div class="one">

                <a href="customer_add.php">
                    <i class="fa-solid fa-user-plus fa-2xl" style="color: #263238;"></i>
                    <h3>Add customer</h3>
                </a>
            </div>



            <div class="two">
                <a href="customer_list.php">
                    <i class="fa-solid fa-users fa-2xl"></i>
                    <h3>Customer Account Management and Reports</h3>
                </a>
            </div>



            <div class="three">

                <a href="manage_customer.php">
                    <i class="fa-solid fa-user-pen fa-2xl"></i>
                    <h3>Manage customer</h3>
                </a>
            </div>




        </div>
        <div class="dash_action_root">

            <div class="one">

                <a href="notifications.php">
                <i class="fa-solid fa-newspaper fa-2xl"></i>
                    <h3>Add News/Notification</h3>
                </a>
            </div>



            <div class="two">
                <a href="branch_details.php">
                <i class="fa-solid fa-building-columns fa-2xl"></i>
                    <h3>Branch Details</h3>
                </a>
            </div>



            <div class="three">

                <a href="contact_admin_view.php">
                <i class="fa-solid fa-info fa-2xl"></i>
                    <h3>Customer Enquiries</h3>
                </a>
            </div>




        </div>

    </center>
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>


</body>

</html>