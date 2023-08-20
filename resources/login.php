<!DOCTYPE html>
<html>
<head>
    <title>Login to Bank</title>
    <style>
        body {
            background-image: url("https://img.freepik.com/free-vector/money-saving-concept_52683-7986.jpg?w=996&t=st=1692520578~exp=1692521178~hmac=0d0d7e68b036a93c2c9330dd49da9fae4b9ca89591e6ccb7031d4e41489c5c70");
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .loginform {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            width: 350px;
            margin: auto;
            margin-top: 100px;
        }

        .loginform h1 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #sub {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #sub:hover {
            background-color: #555;
        }
    </style>
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

