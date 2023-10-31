<?php
include "connection.php"; // Include your database connection file
include "header.php";
include "user_navbar.php";

// Retrieve user_id from the form submission
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
} elseif(isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Handle the case where no user ID is provided
    echo "Invalid request";
    exit();
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve account information from the form
    $account_no = $_POST['account_no'];
    $account_type = $_POST['accountType'];
    $balance = $_POST['balance'];

    // Set default values
    $account_status = "Active";
    $opened_on = date("Y-m-d"); // Get the current date in MySQL format (YYYY-MM-DD)

    // Check if the account number already exists in accounts_table
    $check_sql = "SELECT * FROM accounts_table WHERE account_no = '$account_no' AND user_id = '$user_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>alert('Account with this account number already exists. Please enter a different account number.');</script>";
    } else {
        // Construct SQL query to insert new account into accounts_table
        $sql = "INSERT INTO accounts_table (user_id, account_no, account_type, balance, account_status, opened_on)
                VALUES ('$user_id', '$account_no', '$account_type', '$balance', '$account_status', '$opened_on')";

        // Insert new account into the database
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New account added successfully.');</script>";
        } else {
            echo "Error adding account: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Add New Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Create a form to add a new account -->
        <h2>Add New Account</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="accountNo">Account Number:</label>
                <input type="text" id="accountNo" name="account_no" required>
            </div>

            <div class="form-group">
                <label for="accountType">Account Type:</label>
                <select id="accountType" name="accountType" required>
                    <option value="Current Account">Current Account</option>
                    <option value="Savings Account">Savings Account</option>
                    <option value="Fixed Deposit Account">Fixed Deposit Account</option>
                </select>
            </div>

            <div class="form-group">
                <label for="balance">Balance:</label>
                <input type="number" id="balance" name="balance" required>
            </div>

            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="submit" value="Add Account">
        </form>
    </div><br><br><br>
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>
</body>
</html>
