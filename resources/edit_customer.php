<?php
include "connection.php";
include "header.php";
include "user_navbar.php";

// Initialize variables
$user_id = $first_name = $last_name = $address = $contact_no = $email_id = "";

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer information from the form
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $email_id = $_POST['email_id'];

    // Construct SQL query
    $sql = "UPDATE customer_table SET 
            first_name='$first_name', 
            last_name='$last_name',
            address='$address',
            contact_no='$contact_no',
            email_id='$email_id'
            WHERE user_id='$user_id'";

    // Update customer information in the database
    if ($conn->query($sql) === TRUE) {
        echo "Customer updated successfully";
    } else {
        echo "Error updating customer: " . $conn->error;
    }
}

// Retrieve customer information based on the user ID sent via POST or GET method
if(isset($_POST['id'])){
    $user_id = $_POST['id'];
} elseif(isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // Handle the case where no user ID is provided
    echo "Invalid request";
    exit();
}

// Retrieve customer information from the database based on the user ID
$sql = "SELECT * FROM customer_table WHERE user_id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $address = $row["address"];
    $contact_no = $row["contact_no"];
    $email_id = $row["email_id"];
} else {
    // Handle the case where no customer with the provided ID is found
    echo "Customer not found";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
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

        input[type="text"] {
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
        <h2>Edit Customer</h2>
        <form method="post" action="">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            First Name: <input type="text" name="first_name" value="<?php echo $first_name; ?>"><br><br>
            Last Name: <input type="text" name="last_name" value="<?php echo $last_name; ?>"><br><br>
            Address: <input type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>"><br><br>
            Contact No: <input type="number" name="contact_no" value="<?php echo isset($_POST['contact_no']) ? $_POST['contact_no'] : ''; ?>"><br><br>
            Email ID: <input type="email" name="email_id" value="<?php echo isset($_POST['email_id']) ? $_POST['email_id'] : ''; ?>"><br><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
