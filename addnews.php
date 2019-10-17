<!DOCTYPE html>

<html lang="ar" dir="rtl" >
    <head>
        <title> خبر جدید را اضافه کن </title>
        <?php
        $title = "خبر جدید را اضافه کن";
        require_once "./headerAuthor.php";

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
        ?>        
    </head>
    <body> 
        <br>
        <div class="container">
            <div class="row">

                <form method="post" action="addnews.php" enctype="multipart/form-data">
                    <table class="table">                
                        <tr>
                            <th>عنوان</th>
                            <td><input type="text" name="newstitle" required></td>
                        </tr>                

                        <tr>
                            <th>متن</th>
                            <td><textarea name="newstext" cols="40" rows="5"></textarea></td>
                        </tr>


                    </table>
                    <div>
                        <input type="submit" name="add" id="i_submit" value="بسته جدید را اضافه کنید" class="btn btn-primary">                
                    </div>
                    <br>
                    <div>
                        <a href="news_load.php" >برگشت به صفحه لیست خبرها</a>                
                    </div>            
                </form>
                <br/>
                <?php
                if (isset($_POST['add'])) {
                    $newstitle = trim($_POST['newstitle']);
                    $newstitle = mysqli_real_escape_string($conn, $newstitle);

                    $newstext = trim($_POST['newstext']);
                    $newstext = mysqli_real_escape_string($conn, $newstext);

                    $query3 = "INSERT INTO `News`(`newstitle`, `newstext`) VALUES ('" . $newstitle . "','" . $newstext . "')";

                    $result2 = mysqli_query($conn, $query3);
                    if (!$result2) {
                        echo "نمی توان جدول بسته جدید درست کرد  " . mysqli_error($conn);
                        exit;
                    }
                }
                ?> 
            </div>
        </div>      
        <?php
        if (isset($conn)) {
            mysqli_close($conn);
        }
        require_once "./footer.php";
        ?> 


    </body>
</html>
