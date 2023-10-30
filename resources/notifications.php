<?php
include "header.php";
include "user_navbar.php";
require("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notification Control</title>
    <link rel="stylesheet" type="text/css" href="style/notifications_styles.css">
</head>
<body>
    <center>
    <h2>Add Notification</h2></center>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="notification">Type message to be displayed:</label><br>
        <textarea id="notification" name="notification" rows="5" cols="50"></textarea><br>
        <input type="submit" value="Add Notification">
        <input type="reset" value="Reset">
    </form>
    
    <footer style="background-color: #263238; color: white; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2023 Internet Banking System. All rights reserved.
</footer>
    <?php
    $successMessage = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["notification"])) {
            // veritfy the input to prevent potential security issues
            $notification = htmlspecialchars($_POST["notification"]);

            // Save the notification to a file 
            $notificationFile = 'notifications.txt';
            $timestamp = date("Y-m-d");
            $notificationText = "[$timestamp] $notification" . PHP_EOL;

            // Append the new notification to the file
            file_put_contents($notificationFile, $notificationText, FILE_APPEND | LOCK_EX);

            // Set a success message
            $successMessage = "Notification added successfully!";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_notification"])) {
        // Check if the "delete_notification" field is set in the POST request
        if (isset($_POST["notification"])) {
            // Get the notification text to delete
            $notificationToDelete = $_POST["notification"];

            // Read existing notifications from the file
            $notificationFile = 'notifications.txt';
            if (file_exists($notificationFile)) {
                $notifications = file_get_contents($notificationFile);

                if (!empty($notifications)) {
                    // Replace the notification to delete with an empty string
                    $notifications = str_replace($notificationToDelete, '', $notifications);

                    // Write the modified notifications back to the file
                    file_put_contents($notificationFile, $notifications);

                    // Set a success message 
                    $successMessage = "Notification deleted successfully!";
                } else {
                    $errorMessage = "No notifications available to delete.";
                }
            } else {
                $errorMessage = "Notification file not found.";
            }
        } else {
            $errorMessage = "Notification parameter not provided.";
        }
    }
    ?>

    <?php if (!empty($successMessage)): ?>
        <div class="success-message"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
        <div class="error-message"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    
<hr>
    <button id="viewButton">Tap to view notification history</button>

    <div id="notificationContainer" style="display: none;">
        <?php
        // Read and display notifications from the file
        $notificationFile = 'notifications.txt';
        if (file_exists($notificationFile)) {
            $notifications = file_get_contents($notificationFile);

            if (!empty($notifications)) {
                // Split the content by line breaks to separate notifications
                $notificationLines = explode(PHP_EOL, $notifications);

                // Display each notification with a delete button
                foreach ($notificationLines as $line) {
                    if (!empty($line)) {
                        echo "<div class='notification-box'><span class='notification-text'>" . htmlspecialchars($line) . "</span><button class='delete-notification' name='delete_notification' value='" . htmlspecialchars($line) . "'>Delete</button></div>";
                    }
                }
            } else {
                echo "<p>No notifications available.</p>";
            }
        } else {
            echo "<p>Notification file not found.</p>";
        }
        ?>
        <br><br><br><br><br><br>
    </div>

    <script>
        document.getElementById("viewButton").addEventListener("click", function () {
            document.getElementById("notificationContainer").style.display = "block";
        });

        const deleteButtons = document.querySelectorAll(".delete-notification");
        deleteButtons.forEach(button => {
            button.addEventListener("click", function (e) {
                if (confirm("Are you sure you want to delete this notification?")) {
                    // Submit the form with the notification to delete
                    const form = document.createElement("form");
                    form.method = "post";
                    form.action = "<?php echo $_SERVER['PHP_SELF']; ?>";
                    const notificationInput = document.createElement("input");
                    notificationInput.type = "hidden";
                    notificationInput.name = "notification";
                    notificationInput.value = e.target.value;
                    form.appendChild(notificationInput);
                    const deleteNotificationInput = document.createElement("input");
                    deleteNotificationInput.type = "hidden";
                    deleteNotificationInput.name = "delete_notification";
                    deleteNotificationInput.value = "true";
                    form.appendChild(deleteNotificationInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>

   <!-- <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Add New Notifications</a></p>-->
</body>
</html>
