<?php
require 'mpdf/vendor/autoload.php'; // Include the PSR-3 Logger and Monolog

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a Monolog logger instance
$logger = new Logger('mpdf');
$logger->pushHandler(new StreamHandler('path/to/your/logfile.log', Logger::WARNING));

// Create an mPDF object and set the logger
$mpdf = new \Mpdf\Mpdf(['logger' => $logger]);

// Fetch data from the database
require("connection.php");
include("customer_navbar.php");
$session_account_no = $_SESSION['account_no'];
$sql = "SELECT * FROM transaction_table WHERE from_account_no = $session_account_no";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Create an HTML table to display the data with styling
    $html = '
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                text-align: center;
            }
            .header {
                background-color: #263238;
                color: #fff;
                padding: 10px;
            }
            .logo {
                width: 150px;
                height: auto;
            }
            .title {
                font-size: 24px;
                margin: 20px 0;
            }
            .subtitle {
                font-size: 18px;
                margin: 10px 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #263238;
                color: #fff;
            }
        </style>
        <div class="header">
            <img src="images/logo.png" alt="Logo" class="logo">
            <h1 class="title">IBS Banking PVT LTD</h1>
            <h2 class="subtitle">Transaction statements</h2>
        </div>
        <table>
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Type</th>
                <th>From Account No</th>
                <th>To Account No</th>
                <th>Date Issued</th>
                <th>Amount</th>
            </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['transaction_id'] . '</td>';
        $html .= '<td>' . $row['transcation_type'] . '</td>';
        $html .= '<td>' . $row['from_account_no'] . '</td>';
        $html .= '<td>' . $row['to_account_no'] . '</td>';
        $html .= '<td>' . $row['date_issued'] . '</td>';
        $html .= '<td>' . $row['amount'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Write HTML content to PDF
    $mpdf->WriteHTML($html);

    // Output the PDF as a download
    $mpdf->Output('IBS_Statement.pdf', 'D');
} else {
    echo "Query execution failed: " . mysqli_error($conn);
}

?>