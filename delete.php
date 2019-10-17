<?php

session_start();
require_once "./functions/database_functionsp.php";
$conn = db_connect();

if (!isset($_SESSION['admin'])) {
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);

    exit;
}
if (!$_SESSION['admin']) {
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);

    exit;
}


$delete_id = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_STRING);

$delete_query = "DELETE FROM `users` WHERE userId='$delete_id'"; //delete query  
$run = mysqli_query($conn, $delete_query);

$delete_query = "DELETE FROM `users` WHERE userId='$delete_id'"; //delete query  



if ($run) {
//javascript function to open in the same window   
    echo "<script>window.open('view_users.php?deleted=user has been deleted','_self')</script>";
}
?>  