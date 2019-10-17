<?php

session_start();
$count = 0;
// connecto database
require_once "./functions/database_functionsp.php";
$conn = db_connect();
$query = "SELECT * FROM Packages";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "مشکل در ارتباط با دیتا بیس " . mysqli_error($conn);
    exit;
}
$packages = array();

for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    //while () {     
    $query_row = mysqli_fetch_assoc($result);
    $packages[$i]['packageId'] = isset($query_row['packageId']) ? $query_row['packageId'] : '';
    $packages[$i]['packageState'] = isset($query_row['packageState']) ? $query_row['packageState'] : '';
    $packages[$i]['packageNumber'] = isset($query_row['packageNumber']) ? $query_row['packageNumber'] : '';
    $packages[$i]['packageFig'] = isset($query_row['packageFig']) ? $query_row['packageFig'] : ''; //file_get_contents($image);
    $packages[$i]['packageInfo'] = isset($query_row['packageInfo']) ? $query_row['packageInfo'] : '';
    $packages[$i]['packageTitle'] = isset($query_row['packageTitle']) ? $query_row['packageTitle'] : '';
    $packages[$i]['packageUrl'] = isset($query_row['packageUrl']) ? $query_row['packageUrl'] : '';
    $packages[$i]['packageTimeDur'] = isset($query_row['packageTimeDur']) ? $query_row['packageTimeDur'] : '';

    $count++;
    // }      
}
$packagesJson = json_encode($packages);
echo $packagesJson;

if (isset($conn)) {
    mysqli_close($conn);
}
?>