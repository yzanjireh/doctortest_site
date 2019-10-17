<?php
session_start();
require_once './functions/database_functionsp.php';
$conn=db_connect();
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
$answeruserid = filter_input(INPUT_GET, 'answeruserid', FILTER_SANITIZE_STRING);

        if(notvoteyet($conn,$userId,$answeruserid)){

$query="UPDATE  answerusers SET rate=rate+1 WHERE answeruserid=".$answeruserid;
$res = mysqli_query($conn, $query);
        }
$query="Select rate from  answerusers WHERE answeruserid=".$answeruserid;
$res= mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
        
?>
<h1  style="border-radius: 50%; border: grey; width: 40px;text-align: center;border-style: solid"> <?php echo $row['rate'] ?></h1>                           
        

       

