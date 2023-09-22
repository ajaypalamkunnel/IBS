<?php
include "header.php";
include "customer_navbar.php";
require("connection.php");

$errors = [];
$success = false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $from_account_no = $_POST['from_account_no'];
        $to_account_no = $_POST['to_account_no'];
        $amount = $_POST['amount'];
        $pin = $_POST['pin'];

        // Validate inputs

        // Check if the sender's account exists
        $query = "SELECT a.balance, c.pin 
                  FROM accounts_table a 
                  INNER JOIN customer_table c ON a.user_id = c.user_id 
                  WHERE a.account_no = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            $errors[] = "Error preparing the statement.";
        } else {
            $stmt->bind_param("s", $from_account_no);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows !== 1) {
                $errors[] = "Sender's account does not exist.";
            } else {
                $row = $result->fetch_assoc();
                $sender_balance = $row['balance'];
                $correct_pin = $row['pin'];

                // Check if the entered PIN is invalid
                if (trim($correct_pin) !== trim($pin)) {
                    $errors[] = "Invalid PIN.";
                } else {
                    // Check if sender has insufficient balance
                    if ($sender_balance < $amount) {
                        $errors[] = "Insufficient balance in sender's account.";
                    }
                }
            }
            $stmt->close();
        }

        // Check if the receiver's account exists
        $query = "SELECT balance FROM accounts_table WHERE account_no = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            $errors[] = "Error preparing the statement.";
        } else {
            $stmt->bind_param("s", $to_account_no);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows !== 1) {
                $errors[] = "Receiver's account does not exist.";
            }
            $stmt->close();
        }

        // Amount validation
        if ($amount <= 0) {
            $errors[] = "Invalid amount.";
        }

        // If there are no errors, proceed with the fund transfer
        if (empty($errors)) {
            $conn->autocommit(FALSE); // Disable autocommit to ensure transaction integrity

            // Deduct amount from sender's account
            $sql = "UPDATE accounts_table SET balance = balance - ? WHERE account_no = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                $errors[] = "Error preparing the statement.";
            } else {
                $stmt->bind_param("ds", $amount, $from_account_no);
                $stmt->execute();
                $result = $stmt->affected_rows;

                if ($result > 0) {
                    // Add amount to receiver's account
                    $sql = "UPDATE accounts_table SET balance = balance + ? WHERE account_no = ?";
                    $stmt = $conn->prepare($sql);

                    if (!$stmt) {
                        $errors[] = "Error preparing the statement.";
                    } else {
                        $stmt->bind_param("ds", $amount, $to_account_no);
                        $stmt->execute();
                        $result = $stmt->affected_rows;

                        if ($result > 0) {
                            $conn->commit(); // Commit the transaction
                            $conn->autocommit(TRUE); // Re-enable autocommit
                            $success = true;
                        } else {
                            $conn->rollback(); // Rollback in case of an error
                            $conn->autocommit(TRUE); // Re-enable autocommit
                            $errors[] = "Error updating receiver's account.";
                        }
                    }
                } else {
                    $conn->autocommit(TRUE); // Re-enable autocommit
                    $errors[] = "Error updating sender's account.";
                }
            }
        }
    }
}

// Display error messages
foreach ($errors as $error) {
    echo '<div class="error-alert">' . $error . '</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/fund_transfers_styles.css">
</head>

<body>
    <form id="transferForm" class="fund_transfer_form" method="post" onsubmit="return validateForm()">
        <font Color="Purple">
            <h1>Fund Transfer</h1>
            <div class="form-group">
                <label for="from_account_no">From Account Number:</label>
                <input type="text" id="from_account_no" name="from_account_no" required value="<?php echo isset($_SESSION['account_no']) ? $_SESSION['account_no'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="to_account_no">To Account Number:</label>
                <input type="text" id="to_account_no" name="to_account_no" required>
            </div>

            <!-- Hidden input field for PIN -->
            <input type="hidden" id="pin" name="pin" value="" required>

            <div class="form-group">
                <label for="amount">Amount (INR):</label>
                <input type="number" id="amount" name="amount" required>
            </div>
        </font>
        <br><br>
        <div class="form-group">
            <!-- Use "type='button'" to prevent form submission and call validateForm() on click -->
            <button type="button" onclick="showPinModal()">Transfer Funds</button>
            <button type="reset">Reset</button>
        </div>
    </form>

    <!-- PIN Input Modal -->
    <div id="pinModal" class="pin-modal">
        <div class="pin-modal-content">
            <label for="pinInput">Enter Your PIN:</label>
            <input type="password" id="pinInput" class="pin-input">
            <div class="form-group">
                <button type="button" onclick="hidePinModal()">Cancel</button>
                <button type="button" onclick="validatePin()">Submit</button>
            </div>
        </div>
    </div>

    <!-- Display success message -->
    <?php
    if ($success) {
        echo '<div class="success-alert">Fund transferred successfully.</div>';
    }
    ?>

    <script>
        function validateForm() {
            // Check if all required fields are filled
            var fromAccountNo = document.getElementById("from_account_no").value;
            var toAccountNo = document.getElementById("to_account_no").value;
            var amount = document.getElementById("amount").value;

            if (fromAccountNo === "" || toAccountNo === "" || amount === "") {
                //display an error message
                alert("Please fill in all required fields.");
                return false; // Prevent form submission
            }

            // Show the PIN input modal
            showPinModal();
        }

        function showPinModal() {
            document.getElementById("pinModal").style.display = "block";
        }

        function hidePinModal() {
            document.getElementById("pinModal").style.display = "none";
        }

        function validatePin() {
            var pinInput = document.getElementById("pinInput").value;

            if (pinInput !== "") {
                // PIN is entered, proceed with the transfer
                document.getElementById("pin").value = pinInput;
                document.getElementById("transferForm").submit(); // Submit the form
            } else {
                // display an error message
                alert("Please enter your PIN to continue.");
            }

            // Hide the PIN input modal
            hidePinModal();
        }
    </script>
</body>
</html>
