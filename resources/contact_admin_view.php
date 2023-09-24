<?php
include "header.php";
include "user_navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Enquiries</title>
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
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h3 {
            margin-top: 0;
            color: #007BFF;
        }

        pre {
            white-space: pre-wrap;
            background-color: #f8f8f8;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        p {
            margin: 10px 0;
        }

        p.no-messages {
            font-style: italic;
        }

        /* Added styles for message groups */
        .message-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Customer Enquiries</h2>

    <?php
    // Read and display the contact messages from the text file
    $file = 'contact_messages.txt';

    if (file_exists($file)) {
        $messages = file_get_contents($file);

        if (!empty($messages)) {
            $messageArray = explode("\n\n", $messages);
            $messageCount = count($messageArray);

            if ($messageCount > 0) {
                echo "<h3>Contact Messages</h3>";

                // Loop through messages in reverse order
                for ($i = $messageCount - 1; $i >= 0; $i--) {
                    if (($messageCount - 1 - $i) % 3 === 0) {
                        echo '<div class="message-group">';
                    }

                    echo "<pre>{$messageArray[$i]}</pre>";

                    if (($messageCount - 1 - $i + 1) % 3 === 0 || $i === 0) {
                        echo '</div>';
                    }
                }
            } else {
                echo "<p class='no-messages'>No contact messages available.</p>";
            }
        } else {
            echo "<p class='no-messages'>No contact messages available.</p>";
        }
    } else {
        echo "<p>Message file not found.</p>";
    }
    ?>
</div>

</body>
</html>
