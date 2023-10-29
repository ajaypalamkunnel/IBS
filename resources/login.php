<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style/login_style.css">
    <title>Login to Bank</title>
</head>
<body>
    <div class="loginform">
        <center>
            <h1>Login to IBS</h1>
            <br><br>
            <form method="POST" onclick="redirect()">
                <label for="username">Username:</label>
                <input type="text" placeholder="Username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" placeholder="Password" name="password" required><br><br>

                <label for="role">Role:</label>
                <select name="role" id="role">
                    <option value="Admin">Admin</option>
                    <option value="Customer">Customer</option>
                </select>
                <input type="submit" id="sub" name="login" value="Login"><br><br>
            </form>
        </center>
    </div>
    <?php
session_start(); // Start the session
require("connection.php");

if (isset($_POST["login"])) {
    $n = $_POST['username'];
    $p = $_POST['password'];
    $r = $_POST['role'];
    

    // Use prepared statement to fetch the hashed password from the database
    $sql = "SELECT user_id, password, role FROM login_table WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $n);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $hashedPassword = $user_info['password'];

        // if($r=='admin') {
        
        // }


        // Use password_verify to check if the entered password matches the stored hash
        if (password_verify($p, $hashedPassword)) {
            // Password is correct

            // Store user information in session variables
            $_SESSION['user_id'] = $user_info['user_id'];
            $_SESSION['role'] = $user_info['role'];

            // Fetch the account_no based on user_id
            $sql = "SELECT account_no FROM accounts_table WHERE user_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['user_id']);
            mysqli_stmt_execute($stmt);
            $account_result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($account_result) > 0) {
                $account_info = mysqli_fetch_assoc($account_result);
                $_SESSION['account_no'] = $account_info['account_no'];
            }

            if ($r === 'Admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else if ($r === 'Customer') {
                header("Location: customer_dashboard.php");
                exit();
            } else {
                // Invalid role, handle as needed
                echo "Invalid role!";
            }
        } else {
            echo '<script>alert("Invalid password")</script>';
        }
    } else {
        echo '<script>alert("Invalid login credentials")</script>';
    }

    mysqli_stmt_close($stmt);
}
?>

</body>
</html>