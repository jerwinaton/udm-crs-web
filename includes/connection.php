<?php
$db_host = "localhost"; //server name
$db_user = "root"; //database username
$db_password = ""; //database password
$db_name = "udm"; //database name
try {
    $conn = new PDO("mysql:host={$db_host};db_name={$db_name}", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    $err->getMessage();
}
$status = $conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
echo $status;
