<?php

session_start();
$count = 0;
// connecto database
require_once "./functions/database_functionsp.php";
$conn = db_connect();
// $email = $_SESSION['email'];

$userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);

$query = "SELECT packagebought.userId, packages.courseId, packages.packageId, packageNumber FROM `packagebought` INNER JOIN packages ON packagebought.packageId = packages.packageId WHERE packagebought.userId=" . $userId . ";"; //and state <> 2
//        '".$email."'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "مشکل در ارتباط با دیتا بیس " . mysqli_error($conn);
    exit;
}

// set state of the package 2 it means that it's downloaded. 
// update t1, t2 set t1.field = t2.value where t1.this = t2.that;


//$query2 = "UPDATE packagebought SET state=2 WHERE userId=" . $userId . ";";
////int mysql_query(MYSQL *mysql, const char *stmt_str)
//
//$result2 = mysqli_query($conn, $query2);
//
////$result=$conn->query($query2);
//if (!$result2) {
//    echo "Error updating record: " . $conn->error;
//    exit;
//}

//$res=mysql_query($conn,$query2);

$packages = array();


for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $query_row = mysqli_fetch_assoc($result);
    $packages[$i]['userId'] = isset($query_row['userId']) ? $query_row['userId'] : '';
    $packages[$i]['packageId'] = isset($query_row['packageId']) ? $query_row['packageId'] : '';
    $packages[$i]['packageNumber'] = isset($query_row['packageNumber']) ? $query_row['packageNumber'] : '';
    $packages[$i]['courseId'] = isset($query_row['courseId']) ? $query_row['courseId'] : '';
    $count++;
}
$packagesJson = json_encode($packages);
echo $packagesJson;

if (isset($conn)) {
    mysqli_close($conn);
}
?>