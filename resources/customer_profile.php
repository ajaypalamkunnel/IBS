<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/customer_profile_style.css">
    <title>Customer Details</title>
</head>

<body>
    <?php
    include "connection.php";
    include "header.php";
    include "customer_navbar.php";
    $acc_status = $_SESSION['account_status'];

    if ($acc_status == 'Inactive') {
        echo '<script>alert("Your account is Inactive. Please contact your bank branch."); window.location = "customer_dashboard.php";</script>';
    } else
    ?>
    <div class="container">
        <?php


        $customer_id = $_SESSION['user_id']; // Example: You may fetch the customer ID from a URL parameter or another source
        
        //  SQL query to fetch customer details
        $sql = "SELECT first_name, last_name, contact_no, address, branch,user_id,gender,dob,email_id,join_date FROM customer_table WHERE user_id = '$customer_id'";
        $sql2 = "SELECT account_no, balance FROM accounts_table WHERE user_id = '$customer_id'";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        // Check if the query executed successfully
        if (!$result && $result2) {
            die("Error: " . mysqli_error($conn));
        }

        $row_count = mysqli_num_rows($result);
        $row_count2 = mysqli_num_rows($result2);

        if ($row_count && $row_count2 > 0) {
            $row = mysqli_fetch_assoc($result);
            $row2 = mysqli_fetch_assoc($result2);
            ?>
            <header>
                <h3>User Profile</h3>
            </header>
            <div class="profile_box">
                <div class="img">
                    <p><b>USER</b></p><br>
                    <img src="images/user_profile_pic.png" height="200" width="200" align="middle" /><br>
                    <p>
                        <?php echo $row['user_id'], $row['last_name']; ?>
                    </p><br>
                    <p>
                    <h2>Contact details</h2>
                    </p><br>
                    <p><strong>email id:</strong>
                        <?php echo $row['email_id']; ?>
                    </p>
                    <p><strong>Mobile:</strong>
                        <?php echo $row['contact_no']; ?>
                    </p>
                </div>
                <div class="profile-details">
                    <h3>Personal Details</h3><br>
                    <p><strong>Account Number&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row2['account_no']; ?>
                    </p>
                    <p><strong>First Name&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['first_name']; ?>
                        </form>
                    </p>
                    <p><strong>Last Name&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['last_name']; ?>
                        </form>
                    </p>
                    <p><strong>Gender&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['gender']; ?>
                        </form>
                    </p>
                    <p><strong>DOB&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['dob']; ?>
                        </form>
                    </p>
                    <p><strong>Address&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['address']; ?>
                        </form>
                    </p>
                    <p><strong>Balance&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row2['balance']; ?>
                        </form>
                    </p>
                    <p><strong>Branch&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['branch']; ?>
                        </form>
                    </p>
                    <p><strong>Join date&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo $row['join_date']; ?>
                        </form>
                    </p>
                    <p><strong>Account Type&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</strong>
                        <?php echo "account type"; ?>
                        </form>
                    </p>
                    <p><b>Role&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</b>user</form>
                    </p>
                    <p><strong><a href="transaction_history.php" />Transactions</a></p>
                </div>
            </div>
            <?php
        } else {
            echo "<p>No customer details found</p>";
        }
        mysqli_close($conn);
        ?>

</body>

</html>
<?php
include "about.php";
?>