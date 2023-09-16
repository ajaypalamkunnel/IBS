<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/customer_list_style.css">
    <title>Customer List</title>
</head>
<body>
    <h1>Customer List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Pan Card No</th>
                <th>Aadhar No</th>
                <th>Branch</th>
                <th>Join Date</th>
                <th>Pin</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "header.php";
            include "user_navbar.php";
            // Replace this with code to fetch and display customer data from your database
            $customers = [
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'address' => '123 Main St',
                    'contact' => '123-456-7890',
                    'email' => 'john@example.com',
                    'gender' => 'Male',
                    'dob' => '1990-01-15',
                    'pan_card' => 'ABCDE1234F',
                    'aadhar_no' => '1234 5678 9012',
                    'branch' => 'XYZ Bank',
                    'join_date' => '2022-05-20',
                    'pin' => '12345',
                ],
                // Add more customer data as needed
            ];

            foreach ($customers as $customer) {
                echo "<tr>";
                echo "<td>{$customer['first_name']}</td>";
                echo "<td>{$customer['last_name']}</td>";
                echo "<td>{$customer['address']}</td>";
                echo "<td>{$customer['contact']}</td>";
                echo "<td>{$customer['email']}</td>";
                echo "<td>{$customer['gender']}</td>";
                echo "<td>{$customer['dob']}</td>";
                echo "<td>{$customer['pan_card']}</td>";
                echo "<td>{$customer['aadhar_no']}</td>";
                echo "<td>{$customer['branch']}</td>";
                echo "<td>{$customer['join_date']}</td>";
                echo "<td>{$customer['pin']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
