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
        <h2>Hi Welcome Admin!!</h2>
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
                <a href="">
                    <i class="fa-solid fa-users fa-2xl"></i>
                    <h3>List customers</h3>
                </a>
            </div>



            <div class="three">

                <a href="">
                    <i class="fa-solid fa-user-pen fa-2xl"></i>
                    <h3>Manage customer</h3>
                </a>
            </div>




        </div>
        <div class="dash_action_root">

            <div class="one">

                <a href="">
                <i class="fa-solid fa-newspaper fa-2xl"></i>
                    <h3>Add News/Notification</h3>
                </a>
            </div>



            <div class="two">
                <a href="">
                <i class="fa-solid fa-building-columns fa-2xl"></i>
                    <h3>Branch Details</h3>
                </a>
            </div>



            <div class="three">

                <a href="">
                <i class="fa-solid fa-info fa-2xl"></i>
                    <h3>About</h3>
                </a>
            </div>




        </div>

    </center>



</body>

</html>