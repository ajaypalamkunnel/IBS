<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin_profile_style.css">
    <title>Admin profile</title>
</head>
<body>
    <?php
     include "connection.php";
     include "header.php";
     include "user_navbar.php";?>
        <?php
       

        // Replace this with the customer ID or another identifier
        $customer_id = $_SESSION['user_id']; // Example: You may fetch the customer ID from a URL parameter or another source

        // Replace this with your SQL query to fetch customer details
        $sql = "SELECT user_id,first_name,last_name,email_id,contact_no FROM staff_administrator_table WHERE user_id = '$customer_id'";
        $result = mysqli_query($conn, $sql);

        // Check if the query executed successfully
        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

         $row_count = mysqli_num_rows($result);

        if ($row_count > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <header>
        <h1>Staff Profile</h1>
    </header>
            
        <div class="profile_box">
            <div class="img">
            <p><b>STAFF</b></p><br>
            <img src="images/admin_profile_pic.jpeg" height="200" width="200" align="middle"/><br> 
            <p><strong><?php echo $row['user_id']; ?></strong></p><br>
            <p><h2>Contact details</h2></p>
                <p><strong>email id:</strong> <?php echo $row['email_id']; ?></p>
                <p><strong>Mobile:</strong> <?php echo $row['contact_no']; ?></p>
        </div>
            <div class="profile-details">
                <h2>Personal Information</h2>
                <p><strong><form>First Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong><input type="text" value= "<?php echo $row['first_name']; ?>"readonly></form></p>
                <p><strong><form>Last Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong><input type="text" value= "<?php echo $row['last_name']; ?>"readonly></form></p>
                <p><b><form>Role&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</b><input type="text" value= "Staff"readonly></form></p>
                <p><b><form>Status&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</b><input type="text" value= "Active"readonly></form></p>
            </div>
        </div>
            <?php
        } else {
            echo "<p>No customer details found</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

</body>
</html>
