<?php
include "header.php";
include "user_navbar.php";
include("connection.php");

// Get the account number from the form
$search = $_POST['search'];

// SQL query to retrieve customer data
$search_sql = "SELECT c.*, a.* FROM customer_table c
                 LEFT JOIN accounts_table a ON c.user_id = a.user_id
                 WHERE a.account_no = '$search'";

// Execute the SQL query
$result = $conn->query($search_sql);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style/customer_profile_admin_style.css">
    <title>Customer Profile</title>
</head>

<body>
    <div class="profile-container">
        <div class="profile-avatar">
            <?php
            if ($result === false) {
                echo '<p class="error-message">Error: ' . $conn->error . '</p>';
            } else if ($result->num_rows > 0) {
                // Data retrieved successfully, display the profile image
                echo '<img src="images/logo.png" alt="Customer Avatar">';
            } else {
                // No data found for the provided account number
                echo '<p class="error-message">No customer found for the provided account number.</p>';
            }
            ?>
        </div>
        <div class="profile-info">
            <?php
            // Check if there are results
            if ($result !== false && $result->num_rows > 0) {
                // Fetch the data and display it
                $row = $result->fetch_assoc();
                echo "<h1>{$row["first_name"]} {$row["last_name"]}</h1>";
                echo "<p>Email: {$row["email_id"]}</p>";
                echo "<p>Contact: {$row["contact_no"]}</p>";
                echo "<p>Address: {$row["address"]}</p>";
                echo "<p>Branch: {$row["branch"]}</p>";
                echo "<p>Date of Birth: {$row["dob"]}</p>";
                echo "<p>PAN Card No: {$row["pan_card_no"]}</p>";
                echo "<p>Aadhar No: {$row["aadhaar_no"]}</p>";
                echo "<p>Account status: {$row["account_status"]}</p>";
                echo "<p>Balance: {$row["balance"]}</p>";

            }
            ?>
            <input class="download-button submit-button" name="Report" type="button" value="Report"
                onclick="openPopup()">
            <?php
            $acc_status = $row["account_status"];
            if ($acc_status == 'Inactive') {
                ?>
                <center>
                    <a class="download-button submit-button" name="Activate" type="button" value="Activate"
                        href="activate.php?id=<?php echo $row['user_id']; ?>">Activate</a>
                </center>
                <?php
            } else
            ?>

        </div>

    </div>

    <div class="popup-container" id="popup">
        <div class="popup-content">
            <span class="close-button" onclick="closePopup()">&times;</span>
            <h2>Generate Report</h2>
            <form id="reportForm" action="pdf.php">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>
                <input type="submit" class="download-button submit-button" value="Download">
            </form>
        </div>
    </div>

    <script>
        function openPopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "block";
        }

        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        }

        function generateReport() {
            var startDate = document.getElementById("startDate").value;
            var endDate = document.getElementById("endDate").value;

            // Use JavaScript to create a URL for the report generation
            var reportUrl = "generate_report.php?startDate=" + startDate + "&endDate=" + endDate;

            // Redirect to the report generation script
            window.location.href = reportUrl;
        }
    </script>
</body>