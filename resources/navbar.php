<!DOCTYPE html>
<html>
<head>
    <title>Navigation Bar</title>
    <style>
        /* Navigation bar styles */
        .navigation-bar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        .navigation-bar li {
            float: left;
        }

        .navigation-bar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navigation-bar li a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php
    // Simulating user roles (you would get this information from your authentication system)
    $userRole = "user"; // Replace with "admin" for admin users

    // Logic to determine the appropriate dashboard link based on user role
    if ($userRole === "admin") {
        $homeLink = "admin_dashboard.php"; // Admin dashboard page
    } else {
        $homeLink = "customer_dashboard.php"; // Regular user dashboard page
    }
    ?>

    <ul class="navigation-bar">
        <li><a href="<?php echo $homeLink; ?>">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</body>
</html>
