
<?php
session_start();

require_once './functions/database_functionsp.php';
$conn = db_connect();

if (!isset($_SESSION['userId'])) {
    echo "<script>alert('لطفا ابتدا وارد سایت شوید')</script>";
    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);

    $URL = "login.php";
    echo "<script>location.href='$URL'</script>";
    exit;
}
if ($_SESSION['userId'] == '') {
    echo "<script>alert('لطفا ابتدا وارد سایت شوید')</script>";

    echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);
    $URL = "login.php";
    echo "<script>location.href='$URL'</script>";
    exit;
}
$userId = $_SESSION ['userId'];
$result = getSoalsforuser($conn, $userId);
?>
<div class="panel-primary" style="border-radius: 5px;">

    <div class="panel-heading" style=" border-radius: 5px;background: blue;color:white">
        <h3>لیست سوالهای مطرح شده توسط شما و پاسخ داده شده توسط کاربران </h3>
    </div>
    <?php
    if ($result != null & mysqli_num_rows($result) != 0) {
        ?>
        <div class="panel-body" style="border:3px solid #2f71ab; border-radius: 5px;">
            <table class="table">
                <tr>
                    <th width="3%"> شناسه</th>
                    <th width="81%">متن سوال</th>
                    <th width="8%">عملیات </th>

                    <th width="8%">&nbsp; </th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr>
                        <td><?php echo $row['qId']; ?></td>
                        <td><?php echo $row['qText']; ?></td>
                        <td><a href="deletequestion.php?qId=<?php echo $row['qId']; ?>">حذف</a></td>                   

                        <td><a href="onequestion.php?qId=<?php echo $row['qId']; ?>"> پاسخ ها...</a></td>                   
                    </tr>
                <?php } ?>
            </table>

        </div>
        <?php
    } else {
        ?>
        <div class="panel-body" style="border:3px solid #2f71ab; border-radius: 5px;"> <h2 style="color: tomato">
                سوالی با جستجوی کلمه <mark><?php echo $searchItem ?></mark>  یافت نشد!!!
            </h2></div>
    <?php } ?>
</div>

