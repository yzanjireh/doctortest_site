<?php
session_start();
require_once "./functions/database_functionsp.php";
$conn = db_connect();

$user_email = $_POST["user_email"]; //$_REQUEST["user_email"];//same  filter_input(INPUT_POST, 'email'); //
//$user_email = $_POST['user_email'];
//$user_email = $_GET['user_email'];
//$user_email = $_REQUEST['user_email'];
//$user_email = $_REQUEST["user_email"];
//$user_email = utf8_decode($user_email);

$user_pass1 = $_POST["user_pass"]; //same  filter_input(INPUT_POST, 'pass'); //
//$test='okey';
//echo t2t.$user_email.$user_pass1;
//$user_pass1=utf8_decode($user_pass1);

$user_pass1 = mysql_entities_fix_string($conn, $user_pass1);
    $user_email = mysql_entities_fix_string($conn, $user_email);
    
//$user_pass = sha1($user_pass1);
//$user_pass=password_hash($user_pass1, PASSWORD_BCRYPT);


$check_user = "select userId,password from users WHERE email='$user_email' AND active=1";
$run = mysqli_query($conn, $check_user);
$query_row= mysqli_fetch_assoc($run);

if (password_verify($user_pass1, $query_row['password'])) {
    $userId=isset($query_row['userId']) ? $query_row['userId'] : 0;
    
    //$userJson = json_encode($userId);
echo $userId;

//    echo "ورود موفقیت آمیز بود"; //"<script>window.open('index.php','_self')</script>";
    //$_SESSION['email'] = $user_email; //here session is used and value of $user_email store in $_SESSION.  
} else {
    echo  0;//"ایمیل وارد شده  یا پسورد اشتباه می باشند و یا شما هنوز حساب خود را فعال نکرده اید";
}
?>