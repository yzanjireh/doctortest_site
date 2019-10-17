<?php
session_start();

require_once './functions/database_functionsp.php';
$conn = db_connect();
$userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);
$packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);
$rate = filter_input(INPUT_GET, 'rate', FILTER_SANITIZE_STRING);

if (notvoteyetp($conn, $userId, $packageId)) {
    $query = "UPDATE  packages SET qbyusers=(qbyusers*numofusers+" . $rate . ")/(numofusers+1) WHERE packageId=" . $packageId;
    $res = mysqli_query($conn, $query);
    $query = "UPDATE  packages SET numofusers=numofusers+1 WHERE packageId=" . $packageId;
    $res = mysqli_query($conn, $query);
}
$query = "Select qbyusers from  packages WHERE packageId=" . $packageId;
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);
echo $row['qbyusers'];



