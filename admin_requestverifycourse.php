<?php

session_start();
$courseId = filter_input(INPUT_GET, 'courseId', FILTER_SANITIZE_STRING);


require_once "./functions/database_functionsp.php";
$conn = db_connect();

if (!isset($_SESSION['admin'])) {
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);
    exit;
}
if ($_SESSION['admin'] == '') {
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);
    exit;
}

$query3 = "UPDATE `courses` SET `isverified`=1 WHERE `courseId`='" . $courseId . "';";
$res = mysqli_query($conn, $query3);
echo $res;
// requested to be verified

header("Location: admin_course.php");
?>

