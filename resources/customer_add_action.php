<?php


if($_SERVER['REQUEST_METHOD']=='POST'){
    include ("connection.php");

    $currentTimestamp = time(); // Gets the current UNIX timestamp
    $phpFormattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp);  // Formats the timestamp in "YYYY-MM-DD HH:MM:SS" format

    $username=$_POST['username'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    //$city=$_POST['city'];
    $contactNo=$_POST['phone'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $panCardNo=$_POST['Pancard'];
    $aadhaarNo=$_POST['aadhar'];
    $joinDate=$phpFormattedTimestamp;
    $accNo=$_POST['accountNo']; //acc table
    $balance=$_POST['openingBalance']; //acc table
    $address =$_POST['address'];
    $branch =$_POST['bankBranch'];
    $password =$_POST['password'];
    $pin = $_POST['pin'];

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
    pin
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
    '$pin'
)";
////query for account table
   $sql2 = "INSERT INTO `accounts_table` (account_no, user_id, balance, opened_on) 
   VALUES ('$accNo', '$username', $balance, '$joinDate')";

    

    $checkUsernameQuery = "SELECT COUNT(*) FROM `customer_table` WHERE user_id = '$username'";
    $usernameResult = mysqli_query($conn, $checkUsernameQuery);
    $usernameCount = mysqli_fetch_row($usernameResult)[0];

    if ($usernameCount > 0) {
        echo "Username already exists.";
    } else {
        // Check if the account number already exists in accounts_table
        $checkAccountQuery = "SELECT COUNT(*) FROM `accounts_table` WHERE account_no = '$accNo'";
        $accountResult = mysqli_query($conn, $checkAccountQuery);
        $accountCount = mysqli_fetch_row($accountResult)[0];

        if ($accountCount > 0) {
            echo "Account number already exists.";
        } else {
            // Insert into customer_table
            $result1 = mysqli_query($conn, $sql1);

            // Insert into accounts_table
            $result2 = mysqli_query($conn, $sql2);

            if ($result1 && $result2) {
                echo "Data inserted successfully";
            } else {
                die(mysqli_error($conn));
            }
        }
    }
    
    
}



?>

