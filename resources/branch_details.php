<?php
include "connection.php";
include "header.php";
include "user_navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Internet Banking - Branch Details</title>
    <style>
        .branch {
    width: 80%;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
}

.branch h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

.branch p {
    font-size: 16px;
    margin-bottom: 5px;
}

.branch strong {
    font-weight: bold;
    margin-right: 5px;
}

.branch a {
    color: #007bff;
    text-decoration: none;
}

.branch a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
    <center><h2 style="font-size: 35px;">Branch Details</h2>
</center>

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
<br><br><br><br><br><br>
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>

</body>
</html>
