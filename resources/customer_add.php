<?php
include "header.php";
include "user_navbar.php";
include "customer_add_action.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Signup Form</title>
    <script>
        window.onload = function () {
            var today = new Date();
            var maxDate = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate());
            var dobInput = document.getElementById("dob");
            dobInput.max = maxDate.toISOString().split("T")[0];
        }

    </script>
</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Fill the Form to Add a customer</h2>
                <form action="customer_add_action.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                                required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="others" value="others"
                                required>
                            <label class="form-check-label" for="others">Others</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="aadhar">Aadhar Number</label>
                        <input type="text" class="form-control" id="aadhar" name="aadhar" pattern="[0-9]{12}" required>
                        <small class="form-text text-muted">Enter a valid 12-digit Aadhar number.</small>
                    </div>
                    <div class="form-group">
                        <label for="Pancard">PAN Card Number</label>
                        <input type="text" class="form-control" id="Pancard" name="Pancard"
                            pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" required>
                        <small class="form-text text-muted">Enter a valid PAN card number (e.g., ABCDE1234F).</small>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" required>
                        <small class="form-text text-muted">Enter a valid 10-digit mobile number.</small>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bankBranch">Bank Branch</label>
                        <select class="form-control" id="bankBranch" name="bankBranch" required>
                            <option value="Kottayam">Kottayam</option>
                            <option value="Kochi">Kochi</option>
                            <option value="Thrissur">Thrissur</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="accountType">Account Type</label>
                        <select class="form-control" id="accountType" name="accountType" required>
                            <option value="Current Account">Current Account</option>
                            <option value="Savings Account">Savings Account</option>
                            <option value="Fixed Deposit Account">Fixed Deposit Account</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="accountNo">Account Number</label>
                        <input type="text" class="form-control" id="accountNo" name="accountNo" pattern="[0-9]{12}"
                            required>
                        <small class="form-text text-muted">Enter a valid 12-digit account number.</small>
                    </div>

                   

                    <div class="form-group">
                        <label for="userPhotoe">Account Image</label>
                        <input type="file" name="userPhoto" id="userPhoto">
                        <small class="form-text text-muted">Upload an image for the account (optional).</small>
                    </div>


                    <div class="form-group">
                        <label for="openingBalance">Opening Balance</label>
                        <input type="number" class="form-control" id="openingBalance" name="openingBalance" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pin">PIN</label>
                            <input type="password" class="form-control" id="pin" name="pin" required>
                            <small class="form-text text-muted">Enter a valid PIN of size not less than 4.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div><br><br><br><br>

    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>

</body>

</html>