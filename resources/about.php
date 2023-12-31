<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Internet Banking System</title>
    <style>
        .col {
            font-family: OpenSans-Light;
            color: white;
            text-align: center;
            background-color:#263238 ;
            margin: 0;
            padding: 0;
            line-height: 0.6;
        }

        h5 {
        font-family: OpenSans-Light;
        color: white;
        margin-top: 30px;
        margin-bottom: 10px;
       
        }

        .navigation {
            margin-top: 20px;
            margin-bottom:0px;
        }


        .navigation a {
            margin-right: 20px;
            text-decoration: none;
            color: #007bff;
        }


        footer {
             margin-top: auto;
              background-color: #263238;
                padding: 20px;
        }

        .footer-content {
           text-align: center;
        }

        /* Set styles for smaller screens */
        @media (max-width: 576px) {
            body {
                font-size: 14px; /* Reduce font size for smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="col">
    <p><h5 style="color: #263238;">.</h5></p>

    <p>Welcome to IBS Online Banking - Your Simple, Secure, and Smart Banking Solution!</p>

<p>IBS, short for Internet Banking System, brings the bank to your fingertips. We understand the need for banking that fits your fast-paced lifestyle, and that's exactly what we provide.</p>
<h5>Our Commitment</h5>

At IBS, we are committed to making your banking experience smooth and stress-free. Your trust drives us, and we promise to deliver banking services that are reliable, convenient, and tailored just for you.
    <p>For any inquiries: <a href="contact.php">contact us</a></p> 
        <p>Thank you for choosing IBS Online Banking - where your financial convenience is our top priority!</p>

    <div class="navigation">
        <a href="customer_dashboard.php">Home</a>
      
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
  

    <footer>
        <div class="footer-content">
            <p>&copy; <?php echo date("Y"); ?> Internet Banking System. All rights reserved.</p>
            
        </div>
    </footer>

</body>

</html>
