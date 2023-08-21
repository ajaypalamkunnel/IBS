<?php

$currentTimestamp = time(); // Gets the current UNIX timestamp
$phpFormattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Formats the timestamp in "YYYY-MM-DD HH:MM:SS" format

echo "PHP Formatted Timestamp: " . $phpFormattedTimestamp;


?>