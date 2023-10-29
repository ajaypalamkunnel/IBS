<?php
include "connection.php";
include "header.php";
include "user_navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer</title>
    <style>
        /* Styles for the confirmation message */
        .confirmation-message {
            margin: 20px;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 5px;
            text-align: center;
        }

        /* Styles for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <?php
    // Retrieve customer ID to delete
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];

        // Check if the confirmation form is submitted
        if (isset($_POST['confirm'])) {
            // Construct SQL query for deletion
            $sql = "DELETE FROM customer_table WHERE user_id='$user_id'";

            // Execute the deletion query
            if ($conn->query($sql) === TRUE) {
                // Display success message using JavaScript
                echo "<script type='text/javascript'>
                    window.location.href = 'manage_customer.php';
                    showPopup('Customer deleted successfully!');
            </script>";


            } else {
                echo "Error deleting customer: " . $conn->error;
            }
        } else {
            // Ask for confirmation
            echo "<div class='confirmation-message'>Are you sure you want to delete this customer?<br>
                <form method='post'>
                <input type='submit' name='confirm' value='Yes'>
                <a href='manage_customer.php'>No</a> <!-- Link to go back without deleting -->
                </form>
                </div>";
        }
    } else {
        // Handle the case where no user ID is provided
        echo "Invalid request";
    }
    ?>

    <!-- JavaScript to show the popup -->
    <script>
        function showPopup(message) {
            var popup = document.querySelector('.popup');
            var popupContent = document.querySelector('.popup-content');
            popupContent.innerHTML = message;
            popup.style.display = 'flex';
        }
    </script>

    <!-- Popup HTML -->
    <div class="popup">
        <div class="popup-content"></div>
    </div>
</body>

</html>
