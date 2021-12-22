<?php
$local_db_host = "localhost"; //server name
$local_db_user = "root"; //database username
$local_db_password = ""; //database password
$local_db_name = "xyashmqn_udm"; //database name
try {
    $conn = new PDO("mysql:host={$local_db_host};db_name={$local_db_name}", $local_db_user, $local_db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    $err->getMessage();
}
// $online_db_host = "localhost"; //server name
// $online_db_user = "xyashmqn_udm@localhost"; //database username
// $online_db_password = "#Udmadmin123"; //database password
// $online_db_name = "xyashmqn_udm"; //database name
// try {
//     $conn = new PDO("mysql:host={$online_db_host};db_name={$online_db_name}", $online_db_user, $online_db_password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $err) {
//     $err->getMessage();
// }
//$status = $conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
//echo $status; //get status
