
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/deactivate_style.css"> <!-- Include your external CSS file for styling -->
    <title>Account Number Lookup</title>
</head>
<body>
    <h1>Account Number</h1>
    <div class="form-container">
        <form method="post" action="deactivate.php">
            <label for="accountNumber">Account Number:</label>
            <input type="text" id="accountNumber" name="accountNumber" required>
            <a class='button' href='admin_dashboard.php?"'>Home</a>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
include "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the account number from the form
    $accountNumber = $_POST['accountNumber'];

    // SQL query to update the account status
    $sql = "UPDATE accounts_table SET account_status = 'Inactive' WHERE account_no = '$accountNumber'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo" <script>alert( $accountNumber.'Account status updated successfully.');</script>";
    } else {
        echo "Error updating account status: " . $conn->error;
        
    }
}

// Close the database connection
$conn->close();
?>
