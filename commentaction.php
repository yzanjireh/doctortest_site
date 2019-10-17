<?php
session_start();

require_once './functions/database_functionsp.php';
require_once './header.php';
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
$answeruserid = filter_input(INPUT_GET, 'answeruserid', FILTER_SANITIZE_STRING);
$qId = filter_input(INPUT_GET, 'qId', FILTER_SANITIZE_STRING);
?> 
<?php
if (NULL !== (filter_input(INPUT_POST, 'addc'))) { //$_POST['register']  
    $commentText = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $commentText = mysqli_real_escape_string($conn, $commentText);
    $tableName = "commentusers";
    $query = "INSERT INTO `commentusers` (  `comment`, answeruserid, userId)" .
            " VALUES ('" . $commentText . "'," . $answeruserid . "," . $userId . ")";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "نمی توان نظر را اضافه کرد  " . mysqli_error($conn);
        exit;
    } else {
        echo "<script>alert('نظر شما ثبت گردید به زودی بعد از تایید روی سایت قرار خواهد گرفت ')</script>";
        
                $URL="onequestion.php?qId=" . $qId . " & answeruserid=" . $answeruserid;
        echo "<script>location.href='$URL'</script>";                    
        exit;
    }
    exit;
    $commentid = mysqli_insert_id($conn);
}?>

<div class="container-fluid ">
    <nav class="well well-ls" style="background: #E7F1CD">            
        <center>
            <form method="post" class="form-horizontal">
                <fieldset>
                    <legend  style="background: #00AD00"> سیستم ثبت نظر </legend>

                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label alignright" >نظر شما</label>
                        <!--<div class="col-lg-10">-->
                        <textarea name="message" class="form-control" rows="3" placeholder="نظر شما "></textarea>
<!--				        	<span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                        <!--</div>-->
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-lg-offset-2">

                            <input type="submit" value="ثبت نظر" name="addc" class="btn btn-default">
                            <!--<button href="index.php" font='b nazanin' type="reset" name="reset" class="btn btn-default">انصراف </button>-->
                        </div>
                    </div>
                </fieldset>
            </form>
        </center>
    </nav>
</div>