<?php
date_default_timezone_set('Asia/Calcutta');
$serverName = "103.14.97.85";
$connectionInfo = array(
    "Database" => "stockdb",
    "UID" => "stock",
    "PWD" => "_Yz33Q4c6hjTyxsvg",
    "CharacterSet" => "UTF-8"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);
$AdminURL = 'http://stock.swiftmore.in/Admin/';
$baseURL = 'http://stock.swiftmore.in/';

if ($conn) {
    // echo "Connection established";
} else {
    die("Connection failed: " . $conn->connect_error);
}
?>
