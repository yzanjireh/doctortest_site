<?php
session_start();
$packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);

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

$query3 = "UPDATE `packages` SET `isverified`=2 WHERE `packageId`='" . $packageId . "';";
$res = mysqli_query($conn, $query3);
echo $res;
// requested to be verified

header("Location: admin_package.php");
?>

