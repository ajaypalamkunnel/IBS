<?php


$success = 0;
$user = 0;
$accuser = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require("connection.php");

    $currentTimestamp = time(); // Gets the current timestamp
    $phpFormattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Formats the timestamp in "YYYY-MM-DD HH:MM:SS" format
    $accstat='Active';
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
    $acctyp = $_POST['accountType']; //acc table
    $accNo = $_POST['accountNo']; //acc table
    $balance = $_POST['openingBalance']; //acc table
    $address = $_POST['address'];
    $branch = $_POST['bankBranch'];
    $password = $_POST['password'];
    $pin = $_POST['pin'];
    $role = "Customer";

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
    $sql2 = "INSERT INTO `accounts_table` (account_no, user_id,account_type,account_status, balance, opened_on) 
   VALUES ('$accNo', '$username','$acctyp','$accstat',$balance, '$joinDate')";



    $checkUsernameQuery = "SELECT COUNT(*) FROM `customer_table` WHERE user_id = '$username'";
    $usernameResult = mysqli_query($conn, $checkUsernameQuery);
    $usernameCount = mysqli_fetch_row($usernameResult)[0];
    // Get the Aadhar number from the form
    $aadhar = $_POST['aadhar'];

    // Regular expression pattern for a 12-digit Aadhar number
    $aadharPattern = '/^[0-9]{12}$/';

    // Check if the Aadhar number matches the pattern
    if (preg_match($aadharPattern, $aadhar)) {
        // Aadhar number is valid
    } else {
        // Aadhar number is invalid, display an error message
        echo "Invalid Aadhar number. Please enter a valid 12-digit Aadhar number.";
        // You can also redirect back to the form or take other actions as needed.
    }
    // Get the mobile number from the form
    $mobileNumber = $_POST['phone'];

    // Regular expression pattern for a 10-digit mobile number
    $mobilePattern = '/^[0-9]{10}$/';

    // Check if the mobile number matches the pattern
    if (preg_match($mobilePattern, $mobileNumber)) {
        // Mobile number is valid
    } else {
        // Mobile number is invalid, display an error message
        echo "Invalid mobile number. Please enter a valid 10-digit mobile number.";
        // You can also redirect back to the form or take other actions as needed.
    }
    // Get the PAN card number from the form
    $panCardNumber = $_POST['Pancard'];

    // Regular expression pattern for a valid PAN card number
    $panCardPattern = '/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/';

    // Check if the PAN card number matches the pattern
    if (preg_match($panCardPattern, $panCardNumber)) {
        // PAN card number is valid
    } else {
        // PAN card number is invalid, display an error message
        echo "Invalid PAN card number. Please enter a valid PAN card number (e.g., ABCDE1234F).";
        // You can also redirect back to the form or take other actions as needed.
    }
    // Get the account number from the form
    $accountNumber = $_POST['accountNo'];

    // Regular expression pattern for a valid 12-digit account number
    $accountNumberPattern = '/^[0-9]{12}$/';

    // Check if the account number matches the pattern
    if (preg_match($accountNumberPattern, $accountNumber)) {
        // Account number is valid (exactly 12 digits)
    } else {
        // Account number is invalid, display an error message
        echo "Invalid account number. Please enter a valid 12-digit account number.";
        // You can also redirect back to the form or take other actions as needed.
    }




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
        '; 
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
         Signup successfull
        </div>
        </div>
        <div class="text-center ">
        <a href="customer_add.php" class="btn btn-outline-success">Add more</a>
    </div>'; // Closing div added
    }


    ?>
</body>

</html>