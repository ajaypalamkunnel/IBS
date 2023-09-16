<?php


$success = 0;
$user = 0;
$accuser = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("connection.php");

    $currentTimestamp = time(); // Gets the current UNIX timestamp
    $phpFormattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Formats the timestamp in "YYYY-MM-DD HH:MM:SS" format

    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    //$city=$_POST['city'];
    $contactNo = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $panCardNo = $_POST['Pancard'];
    $aadhaarNo = $_POST['aadhar'];
    $joinDate = $phpFormattedTimestamp;
    $accNo = $_POST['accountNo']; //acc table
    $balance = $_POST['openingBalance']; //acc table
    $address = $_POST['address'];
    $branch = $_POST['bankBranch'];
    $password = $_POST['password'];
    $pin = $_POST['pin'];
    $role = "customer";

    //query for customer table 
    $sql1 = "INSERT INTO `customer_table` (
    user_id, 
    first_name, 
    last_name, 
    contact_no, 
    email_id, 
    gender, 
    dob, 
    pan_card_no, 
    aadhaar_no, 
    join_date, 
    address, 
    pin,
    branch
) VALUES (
    '$username', 
    '$firstName', 
    '$lastName', 
    '$contactNo', 
    '$email', 
    '$gender', 
    '$dob', 
    '$panCardNo', 
    '$aadhaarNo', 
    '$joinDate', 
    '$address', 
    '$pin',
    '$branch'
)";

    //query for login table

    $sqlforlogin = "INSERT INTO `login_table` (user_id, password, role) VALUES ('$username', '$password', '$role')";

    ////query for account table
    $sql2 = "INSERT INTO `accounts_table` (account_no, user_id, balance, opened_on) 
   VALUES ('$accNo', '$username', $balance, '$joinDate')";



    $checkUsernameQuery = "SELECT COUNT(*) FROM `customer_table` WHERE user_id = '$username'";
    $usernameResult = mysqli_query($conn, $checkUsernameQuery);
    $usernameCount = mysqli_fetch_row($usernameResult)[0];

    if ($usernameCount > 0) {
        $user = 1;
        //echo "Username already exists.";
    } else {
        // Check if the account number already exists in accounts_table
        $checkAccountQuery = "SELECT COUNT(*) FROM `accounts_table` WHERE account_no = '$accNo'";
        $accountResult = mysqli_query($conn, $checkAccountQuery);
        $accountCount = mysqli_fetch_row($accountResult)[0];

        if ($accountCount > 0) {
            $accuser = 1;
            // echo "Account number already exists.";
        } else {
            // Insert into customer_table
            $result1 = mysqli_query($conn, $sql1);

            // Insert into accounts_table
            $result2 = mysqli_query($conn, $sql2);
            $resultlog = mysqli_query($conn, $sqlforlogin);

            if ($result1 && $result2) {
               // echo "Data inserted successfully";
                $success = 1;
            } else {
                die(mysqli_error($conn));
            }
        }
    }


}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Signup</title>
</head>

<body>
    <?php
    if ($user) {
        echo '<div class="alert alert-danger mt-4  d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            Sorry!!!! This username is already exist
        </div>
    </div>

    <div class="text-center ">
        <a href="customer_add.php" class="btn btn-outline-success">Try again</a>
    </div>
        '; // Closing div added
    }

    if ($accuser) {
        echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        sorry!!!! This Account number is already exist<br>
        </div>
        
        </div>
        <div class="text-center ">
        <a href="customer_add.php" class="btn btn-outline-success">Try again</a>
    </div>
        ';
    }
    ?>

    <?php
    if ($success) {
        echo '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
         Signup successfully
        </div>
        </div>
        <div class="text-center ">
        <a href="customer_add.php" class="btn btn-outline-success">Add more</a>
    </div>'; // Closing div added
    }


    ?>
</body>

</html>