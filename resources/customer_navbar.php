<?php
    require("connection.php"); // Include your database connection file

    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            margin:0
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/customer_navbar_style.css">
    <script src="jquery-3.2.1.min.js"></script>
</head>

<body>
    <div class="nav-wrapper">
        <div class="topnav" id="theTopNav">
            <a href="javascript:void(0);" class="icon" onclick="openNav()" id="hamburger">
                &#9776;
            </a>
            <a id="user">Welcome  <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?> </a>
            <a id="logout" href="login.php" onclick="return confirm('Are you sure?')">Logout</a>
            <a id="profile" href="customer_profile.php">My Profile</a>
            <a id="profile" href="net-banking/customer_navbar.php">About</a>
            <a id="profile" href="customer_dashboard.php">Home</a>
        </div>
    </div>

<script>
// Function below is jquery-3 function used for making the navbar sticky
$(document).ready(function() {
  $(window).scroll(function () {
    if ($(window).scrollTop() > 120) {
      $("#theTopNav").addClass('navbar-fixed');
    }
    if ($(window).scrollTop() < 121) {
      $("#theTopNav").removeClass('navbar-fixed');
  }
  });
});
</script>

</body>
</html>
