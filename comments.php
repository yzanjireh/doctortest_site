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
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);?>
    <script><?php echo("location.href = 'login.php';"); ?></script><?php
    exit;
}
$answeruserid = filter_input(INPUT_GET, 'answeruserid', FILTER_SANITIZE_STRING);
$qId = filter_input(INPUT_GET, 'qId', FILTER_SANITIZE_NUMBER_INT);?>    
    
<a href="commentaction.php?qId=<?php echo $qId ?>&answeruserid=<?php echo $answeruserid ?>"> نظر بدهید</a>

    <?php
$result = getcommentsforquestion($conn, $answeruserid);
if ($result != null) {
    ?>
    <table class="table">           
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td width="95%"><?php echo $row['comment']; ?><a><?php echo username($conn,$row['userId']); ?></a>             
                </td>                       
            </tr>
        <?php } ?>                
    </table>

<?php } ?>







