<!DOCTYPE html>
<html lang="FA" dir="RTL">
    <head>
        <?php
        require_once './header.php';
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
        $qId = filter_input(INPUT_GET, 'qId', FILTER_SANITIZE_STRING);?>
        <title>جواب</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="right">
                </div>
                <div class="left">

                    <form method="post" action="submitansweraction.php" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <th>جواب سوال</th>
                                <td><textarea style="width:100%" name="qAns" rows="5" required></textarea></td>
                            </tr>
                            <tr>
                                <th>تصویر اول جواب </th>
                                <td><input type="file" name="aFig1"></td>
                            </tr>
                            <tr>
                                <th>تصویر دوم جواب </th>
                                <td><input type="file" name="aFig2"></td>
                            </tr>                
                        </table>
                        <input type="hidden" name="qId" value="<?= $qId; ?>" />
                        <input type="submit" name="addq" value="جواب  را اضافه کن" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
