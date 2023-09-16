<!DOCTYPE html>
<html lang="en-GB">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/customer_list_style.css">
    <title>Customer List</title>
</head>

<body>

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
                <th>Join Date & time</th>
                <th>Pin</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "header.php";
            include "user_navbar.php";
            include "connection.php";

            $customer_sql = "SELECT * FROM customer_table";
            $result = $conn->query($customer_sql);
            if ($result->num_rows > 0) {
                // while ($row = $result->fetch_assoc()) {
                //     echo "   " . $row["first_name"];



                    //
            


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
                }

        //    }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                 echo "<td>{$row["first_name"]}</td>";
                 echo "<td>{$row["last_name"]}</td>";
                 echo "<td>{$row["address"]}</td>";
                 echo "<td>{$row["contact_no"]}</td>";
                 echo "<td>{$row["email_id"]}</td>";
                 echo "<td>{$row["gender"]}</td>";
                 echo "<td>{$row["dob"]}</td>";
                 echo "<td>{$row["pan_card_no"]}</td>";
                 echo "<td>{$row["aadhaar_no"]}</td>";
                 echo "<td>{$row["branch"]}</td>";
                 echo "<td>{$row["join_date"]}</td>";
                 echo "<td>{$row["pin"]}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>