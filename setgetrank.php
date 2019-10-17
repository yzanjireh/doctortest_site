<?php

session_start();
$count = 0;
// connecto database
require_once "./functions/database_functionsp.php";
$conn = db_connect();

$grade = $_GET['grade'];
$userId = $_GET['userId'];

$packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);


$query = "UPDATE packagebought SET grade=" . $grade . " WHERE userId=" . $userId . " AND packageId=" . $packageId;

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "مشکل در ارتباط با دیتا بیس " . mysqli_error($conn);
    exit;
}

$query2 = "SELECT COUNT(1) FROM packagebought WHERE grade >= " . $grade . " AND packageId=" . $packageId;
$result = mysqli_query($conn, $query2);
$query_row = mysqli_fetch_assoc($result);

$order[0]['rotbeh'] = isset($query_row['COUNT(1)']) ? $query_row['COUNT(1)'] : '';



$query3 = "SELECT COUNT(1) FROM packagebought WHERE packageId=" . $packageId;
$result = mysqli_query($conn, $query3);
$query_row = mysqli_fetch_assoc($result);

$order[0]['numberofusers'] = isset($query_row['COUNT(1)']) ? $query_row['COUNT(1)'] : '';


$order = json_encode($order);
echo $order;

if (isset($conn)) {
    mysqli_close($conn);
}
?>