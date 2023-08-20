
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
</head>
<body>
    
    <div class="container mt-5">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Fill the Form to Add a customer</h2>
                <form action="customer_add_action.php" method="post">
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
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="others" value="others" required>
                            <label class="form-check-label" for="others">Others</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="aadhar">Aadhar Number</label>
                        <input type="text" class="form-control" id="aadhar" name="aadhar" required>
                    </div>
                    <div class="form-group">
                        <label for="aadhar">Pancard Number</label>
                        <input type="text" class="form-control" id="Pancard" name="Pancard" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bankBranch">Bank Branch</label>
                        <select class="form-control" id="bankBranch" name="bankBranch" required>
                            <option value="branch1">Kottayam</option>
                            <option value="branch2">Kochi</option>
                            <option value="branch3">Thrissur</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accountNo">Account Number</label>
                        <input type="text" class="form-control" id="accountNo" name="accountNo" required>
                    </div>
                    <div class="form-group">
                        <label for="openingBalance">Opening Balance</label>
                        <input type="number" class="form-control" id="openingBalance" name="openingBalance" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pin">PIN</label>
                            <input type="password" class="form-control" id="pin" name="pin" required>
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
                    <button type="submit"  class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
