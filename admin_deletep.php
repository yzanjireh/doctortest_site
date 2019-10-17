<?php

session_start();
$packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);


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


$query = "DELETE FROM packages WHERE packageId = '$packageId'";

$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$directory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "docfiles/" .$courseId . '/'. $packageId . '/';



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

$packageTable = "package" . $packageId;
$queri2 = "DROP TABLE IF EXISTS " . $packageTable;

mysqli_query($conn, $queri2);

$result = mysqli_query($conn, $query);
if (!$result) {
    echo "delete data unsuccessfully " . mysqli_error($conn);
    exit;
}



header("Location: admin_package.php");
?>