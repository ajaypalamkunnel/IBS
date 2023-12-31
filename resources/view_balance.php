<?php
include "header.php";
include "customer_navbar.php";
require("connection.php");
$acc_status = $_SESSION['account_status'];

if ($acc_status == 'Inactive') {
    echo '<script>alert("Your account is Inactive. Please contact your bank branch."); window.location = "customer_dashboard.php";</script>';
} else
    if (!isset($_SESSION['account_no'])) {
        // Redirect to the login page if the account number is not set in the session
        header("Location: login.php");
        exit();
    }

$session_account_no = $_SESSION['account_no'];
$balance = "N/A";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['account_no'])) {
        $input_account_no = $_POST['account_no'];

        // Query the database to fetch the user's balance using the account number and verify it belongs to the logged-in user
        $query = "SELECT balance FROM accounts_table WHERE account_no = ? AND user_id = ?";

        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "ss", $input_account_no, $_SESSION['user_id']);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $balance = $row['balance'];
            } else {
                $balance = "N/A"; // Account not found for the logged-in user
            }
        } else {
            die("Query failed: " . mysqli_error($conn));
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Balance</title>
    <link rel="stylesheet" href="style/view_balance_styles.css">
    <!-- Add this line to link to your external CSS file -->
</head>

<body>
    <h2>View Your Account Balance</h2>
    <form method="POST" action="">
        <label for="account_no">Your account number:</label>
        <br><br>
        <input type="text" id="account_no" name="account_no" value="    ">
        <p>
            <center>
                <button type="submit">View Balance</button>
            </center>
        </p>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if ($balance !== "N/A") {
            echo "<p class='success'>Your account balance is: $balance</p>";
        } else {
            echo "<p class='error'>Account not found for the logged-in user.</p>";
        }
    }
    ?>
    <br><br><br><br><br><br><br><br><br><br><br><br>
</body>

</html>
<?php
include "about.php";
?>