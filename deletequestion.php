<?php
session_start();
require_once './functions/database_functionsp.php';
$conn = db_connect();
if (!isset($_SESSION['userId'])) {
    echo "<script>alert('لطفا ابتدا وارد سایت شوید')</script>";
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);
    ?>

    <script><?php echo("location.href = 'login.php';"); ?></script><?php
    exit;
}
if ($_SESSION['userId'] == '') {
    echo "<script>alert('لطفا ابتدا وارد سایت شوید')</script>";

    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);
    ?>
    <script><?php echo("location.href = 'login.php';"); ?></script><?php
    exit;
}
$userId = $_SESSION['userId'];

$qId = filter_input(INPUT_GET, 'qId', FILTER_SANITIZE_NUMBER_INT);
$query = "DELETE FROM `usersquestions` WHERE qId=". $qId;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "نمی توان سوال را حذف کرد  " . mysqli_error($conn);
        exit;
    } else {        
        $URL="questionsandanswers.php";
        echo "<script>location.href='$URL'</script>";
        exit;
    }
    exit;
?>
