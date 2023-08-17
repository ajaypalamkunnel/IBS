<!DOCTYPE html>
<html>
<head>
    <title>Login to IBS</title>
</head>
<body>
        <div class="loginform">
            <center>
            <big><h1>Login TO IBS</h1>
            <br><br>
            <form method="POST" onclick="redirect()">
            <label for="username">Username:</label>
                <input type="text" placeholder="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" placeholder="password" name="password" required><br><br>
                <label for="role">Role:</label>
                <input type="text" placeholder="Admin/Customer" name="role" required><br><br>
                <input type="submit" id="sub" name="login" value="login"><br><br>
            </form>
</center>
        </div>

    <?php
    require("connection.php");

    if (isset($_POST["login"])) {
        $n = $_POST['username']; 
        $p = $_POST['password']; 
        $r = $_POST['role']; 
        
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM login_table WHERE user_id=? AND password=? AND role=?";
        $state = mysqli_prepare($conn, $sql);
       mysqli_stmt_bind_param($state, "sss", $n, $p, $r);
        mysqli_stmt_execute($state);
        $result = mysqli_stmt_get_result($state);
        //$result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            //echo "Record is found";
            
                if ($r === 'admin') {
                    header("Location: admin_dashboard.php");
                    exit();
                } else if ($r === 'customer') {
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

