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
    require("connection.php");

    if (isset($_POST["login"])) {
        $n = $_POST['username']; 
        $p = $_POST['password']; 
        $r = $_POST['role']; 
        
        // Use prepared statement for SQL execution
        $sql = "SELECT * FROM login_table WHERE user_id=? AND password=? AND role=?";
        $state = mysqli_prepare($conn, $sql); //returns statement object or false if error occurs
       mysqli_stmt_bind_param($state,"sss", $n, $p, $r);
        mysqli_stmt_execute($state);
        $result = mysqli_stmt_get_result($state);
        //$result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            //echo "Record is found";
            
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
            }
         else {
            echo "Invalid login";
        }

        mysqli_stmt_close($state);
    }
    ?>

</body>
</html>

