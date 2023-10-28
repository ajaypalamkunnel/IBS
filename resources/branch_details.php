<?php
include "connection.php";
include "header.php";
include "user_navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Internet Banking - Branch Details</title>
</head>
<body>
    <h2>Branch Details</h2>

    <div class="branch">
        <h2>Branch 1</h2>
        <p><strong>Location:</strong> Lal Bahadhr Shastri Rd, Kottyam, Kerala </p>
        <p><strong>Phone:</strong> 123-456-7890</p>
        <p><strong>Email:</strong> ibs@branch1.com</p>
    </div>

    <div class="branch">
        <h2>Branch 2</h2>
        <p><strong>Location:</strong> Edappally, Kochi, Kerala</p>
        <p><strong>Phone:</strong> 987-654-3210</p>
        <p><strong>Email:</strong> ibs@branch2.com</p>
    </div>

    <div class="branch">
        <h2>Branch 3</h2>
        <p><strong>Location:</strong> Edakkuni Rd, Trissur, Kerala</p>
        <p><strong>Phone:</strong> 555-123-4567</p>
        <p><strong>Email:</strong>ibs@branch3.com</p>
    </div>


    <hr>

    <a href="admin_dashboard.php">Back to Home</a>
</body>
</html>