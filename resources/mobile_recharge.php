<?php
include "header.php";
include "customer_navbar.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/mobile_recharge_style.css"> <!-- Link to your CSS file -->
    <script src="https://kit.fontawesome.com/8e0f91f1ba.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-description">
            <p>Recharge your mobile with ease. Fill in the details below:</p>
        </div>

        <div class="form-container">
            <form class="mobile-recharge-form" action="process_recharge.php" method="post">
                <input type="text" name="mobile_number" placeholder="Enter Mobile Number" required>
                <select name="operator" required>
                    <option value="" disabled selected>Select Operator</option>
                    <option value="Airtel">Airtel</option>
                    <option value="Vodafone Idea">Vodafone Idea</option>
                    <option value="Jio">Jio</option>
                    <!-- Add more operators as needed -->
                </select>
                <select name="recharge_plan" required>
                    <option value="" disabled selected>Select Recharge Plan</option>
                    <option value="10">Plan 1 - ₹10</option>
                    <option value="20">Plan 2 - ₹20</option>
                    <option value="30">Plan 3 - ₹30</option>
                    <!-- Add more plans as needed -->
                </select>
                <button type="submit">Recharge</button>
            </form>
        </div>
    </div>

   


</body>

</html>