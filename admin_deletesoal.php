<?php

session_start();
$packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);
$qId = filter_input(INPUT_GET, 'qId', FILTER_SANITIZE_STRING);
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

$query = "DELETE FROM package" . $packageId . " WHERE qId = '" . $qId . "'";

$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "docfiles/" .$courseId . '/'. $packageId . "/soalat/";



$result = mysqli_query($conn, $query);

header("Location: admin_soalatpackage.php?packageId=" . $packageId."&courseId=".$courseId);
?>