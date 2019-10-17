<?php

session_start();
$count = 0;
// connecto database
require_once "./functions/database_functionsp.php";
$userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);

$conn = db_connect();
$query = "SELECT * FROM `courses` WHERE courseId IN (select courseId from coursebought where userId=" . $userId . " and state = 2);";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "مشکل در ارتباط با دیتا بیس " . mysqli_error($conn);
    exit;
}
$courses = array();


for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    //while () {     
    $query_row = mysqli_fetch_assoc($result);
    $courses[$i]['courseId'] = isset($query_row['courseId']) ? $query_row['courseId'] : '';
    $courses[$i]['courseState'] = isset($query_row['courseState']) ? $query_row['courseState'] : '';
    $courses[$i]['coursePrice'] = isset($query_row['coursePrice']) ? $query_row['coursePrice'] : '';
    $courses[$i]['courseFig'] = isset($query_row['courseFig']) ? $query_row['courseFig'] : ''; //file_get_contents($image);
    $courses[$i]['courseInfo'] = isset($query_row['courseInfo']) ? $query_row['courseInfo'] : '';
    $courses[$i]['courseTitle'] = isset($query_row['courseTitle']) ? $query_row['courseTitle'] : '';
    $courses[$i]['courseUrl'] = isset($query_row['courseUrl']) ? $query_row['courseUrl'] : '';
        $courses[$i]['courseType'] = isset($query_row['courseType']) ? $query_row['courseType'] : '';

    //$courses[$i]['courseTimeDur'] = isset($query_row['courseTimeDur']) ? $query_row['courseTimeDur'] : '';

	    $courses[$i]['branchId'] = isset($query_row['branchId']) ? $query_row['branchId'] : '';
    $courses[$i]['courseId'] = isset($query_row['courseId']) ? $query_row['courseId'] : '';

    $count++;
    // }      
}
$coursesJson = json_encode($courses);
echo $coursesJson;

if (isset($conn)) {
    mysqli_close($conn);
}
?>