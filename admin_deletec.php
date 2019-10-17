<?php

session_start();
$courseId = filter_input(INPUT_GET, 'courseId', FILTER_SANITIZE_STRING);


require_once "./functions/database_functionsp.php";
$conn = db_connect();

 if (!isset($_SESSION['admin'])) {
            echo "<script>alert('لطفا ابتدا وارد سایت شوید')</script>";
            ?>
            <script><?php echo("location.href = 'admin.php';"); ?></script><?php
            exit;
        }
        if ($_SESSION['admin'] == '') {
            echo "<script>alert('لطفا ابتدا وارد سایت شوید')</script>";
            ?>
            <script><?php echo("location.href = 'admin.php';"); ?></script><?php
            exit;
        }        

$query23="select packageId from packages where courseId=".$courseId;
$result=mysqli_query($conn, $query23);
while ($row = mysqli_fetch_assoc($result)){
        $queri2 = "DROP TABLE IF EXISTS package" . $row['packageId'];
mysqli_query($conn, $queri2);

}


        
$query = "DELETE FROM courses WHERE courseId = '$courseId'";

$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$directory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "docfiles/" . $courseId . '/';



recursiveRemoveDirectory($directory);

function recursiveRemoveDirectory($directory) {
    foreach (glob("{$directory}/*") as $file) {
        if (is_dir($file)) {
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}

$courseTable = "course" . $courseId;
$queri2 = "DROP TABLE IF EXISTS " . $courseTable;

mysqli_query($conn, $queri2);

$result = mysqli_query($conn, $query);
if (!$result) {
    echo "delete data unsuccessfully " . mysqli_error($conn);
    exit;
}



header("Location: admin_course.php");
?>