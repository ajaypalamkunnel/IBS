
<?php
include "header.php";
include "customer_navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact IBS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            font-size:35px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 250px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $displayMessage = "";
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];

            // Save the message to a text file
            $file = 'contact_messages.txt';
            $data = "Name: $name\nEmail: $email\nMessage: $message\n\n";
            file_put_contents($file, $data, FILE_APPEND);

            // Display a confirmation message
            $displayMessage = "<h2>Thank you, $name!</h2>";
            $displayMessage .= "<p>Your message has been received.</p> <p><strong>Email:</strong> $email</p><p><strong>Message:</strong> $message</p>";
            echo "<br>";
        } else {
            // Display the contact form if it's not a POST request.
            $displayMessage = "<h2>Contact Bank</h2>";
            $displayMessage .= '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                
                <input type="submit" value="Submit">
                <input type="reset" value="Reset">
            </form>';
        }
        
        echo $displayMessage;
        ?>
    </div>
</body>
</html>
<?php
include "about.php";
?>