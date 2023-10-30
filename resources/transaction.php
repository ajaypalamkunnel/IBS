<?php
include "header.php";
include "customer_navbar.php";
require("connection.php");

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $from_account_no = $_POST['from_account_no'];
    $amount = $_POST['amount'];
    $pin = $_POST['pin'];
    $to_account_no = $_POST['to_account_no'];
    $ifsc = $_POST['ifsc'];

    // Validate inputs

     // Validate if the from_account_no belongs to the logged-in user_id and is a Current Account
     $query = "SELECT a.balance, c.pin, a.account_type 
     FROM accounts_table a 
     INNER JOIN customer_table c ON a.user_id = c.user_id 
     WHERE a.account_no = ? AND a.user_id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
$errors[] = "Bank server down! Please try after sometime.";//Error preparing the statement.
} else {
$stmt->bind_param("ss", $from_account_no, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
   $errors[] = "Invalid sender account number.";
} else {
   $row = $result->fetch_assoc();
   $sender_balance = $row['balance'];
   $correct_pin = $row['pin'];
   $account_type = $row['account_type'];

   // Check if the entered PIN is invalid
   if (trim($correct_pin) !== trim($pin)) {
       $errors[] = "Invalid PIN.";
   } else {
       // Check if sender has insufficient balance
       if ($sender_balance < $amount) {
           $errors[] = "Insufficient balance in your account.";
       } else if ($account_type == "Fixed Deposit Account") {
           $errors[] = "Transaction not possible! Your are trying to perform transaction from a Fixed Deposit account.";
       }
   }
}
$stmt->close();
}


    // Validate to_account_no and IFSC
    $query = "SELECT account_number, ifsc FROM inter_bank_accounts_table WHERE account_number = ? AND ifsc = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        $errors[] = "Bank server down! Please try after sometime.";//Error preparing the statement.
    } else {
        $stmt->bind_param("ss", $to_account_no, $ifsc);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows !== 1) {
            $errors[] = "Invalid recipient account number or IFSC.";
        } else {
            // Fetch the account number and IFSC for further use if needed
            $stmt->bind_result($fetchedAccountNumber, $fetchedIFSC);
            $stmt->fetch();
            // Now $fetchedAccountNumber and $fetchedIFSC contain the retrieved values
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
            $errors[] = "Bank server down! Please try after sometime.";//Error preparing the statement.
        } else {
            $stmt->bind_param("ds", $amount, $from_account_no);
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result > 0) {
                // Add amount to receiver's account
                $sql = "UPDATE inter_bank_accounts_table SET balance = balance + ? WHERE account_number = ?";
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    $errors[] = "Bank server down! Please try after sometime.";//Error preparing the statement.
                } else {
                    $stmt->bind_param("ds", $amount, $to_account_no);
                    $stmt->execute();
                    $result = $stmt->affected_rows;

                    if ($result > 0) {
                        // Generate 12-digit transaction_id
                        $transaction_id = generateTransactionId();

                        // Get current date and time
                        $date_issued = date("Y-m-d H:i:s");

                           // Insert transaction entry into transaction_table
    $sql = "INSERT INTO transaction_table (transaction_id, transaction_type, from_account_no, to_account_no, date_issued, amount) VALUES (?, 'Inter-Bank transaction', ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $transaction_id = generateTransactionId();
        $date_issued = date("Y-m-d H:i:s");
        $stmt->bind_param("ssssd", $transaction_id, $from_account_no, $fetchedAccountNumber, $date_issued, $amount);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $conn->commit(); // Commit the transaction
            $conn->autocommit(TRUE); // Re-enable autocommit
            $success = true;
        } else {
            $conn->rollback(); // Rollback in case of an error
            $conn->autocommit(TRUE); // Re-enable autocommit
            $errors[] = "Bank server down! Please try after sometime. " . $stmt->error; //Error preparing the statement.
        }
        $stmt->close();
    } else {
        $conn->rollback(); // Rollback in case of an error
        $conn->autocommit(TRUE); // Re-enable autocommit
        $errors[] = "Bank server down! Please try after sometime. " . $conn->error; //Error preparing the statement.
    }

                    } else {
                        $conn->rollback(); // Rollback in case of an error
                        $conn->autocommit(TRUE); // Re-enable autocommit
                        $errors[] = "Bank server down! Please try after sometime."; //Error updating receiver's account.
                    }
                }
            } else {
                $conn->autocommit(TRUE); // Re-enable autocommit
                $errors[] = "Bank server down! Please try after sometime."; //Error updating sender's account.
            }
        }
    }
}

// Display error messages
foreach ($errors as $error) {
    echo '<div class="error-alert">' . $error . '</div>';
}
if ($success) {
    // Redirect to a fresh page after a successful transaction   
    $_SESSION['transaction_id'] = generateTransactionId();
    $_SESSION['amount'] = $amount;
    $_SESSION['from_account_no'] = $from_account_no;
    $_SESSION['to_account_no'] = $to_account_no;
    $_SESSION['date_issued'] = date("Y-m-d H:i:s");

    header("Location: transaction_action.php");
    exit();
}

function generateTransactionId() {
    // Generate a 12-character alphanumeric transaction ID
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $transaction_id = '';
    for ($i = 0; $i < 12; $i++) {
        $transaction_id .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $transaction_id;
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
            <center><h2 style="font-size:40px;">IBS Banking Transaction</h2></center>
            <div class="form-group">
                <label for="from_account_no">From Account Number:</label>
                <input type="text" id="from_account_no" name="from_account_no" required value="<?php echo isset($_SESSION['account_no']) ? $_SESSION['account_no'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="to_account_no">To Account Number:</label>
                <input type="text" id="to_account_no" name="to_account_no" required>
            </div>

            <div class="form-group">
                <label for="ifsc">IFSC Code:</label>
                <input type="text" id="ifsc" name="ifsc" required>
            </div>     

            <!-- Hidden input field for PIN -->
            <input type="hidden" id="pin" name="pin" value="" required>

            <div class="form-group">
                <label for="amount">Amount (INR):</label>
                <input type="text" id="amount" name="amount" required>
            </div>
        </font>
        <br><br>
        <div class="form-group">
            <!-- Use "type='button'" to prevent form submission and call validateForm() on click -->
            <button type="button" onclick="showPinModal()">Transfer</button>
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
<?php
include "about.php";
?>