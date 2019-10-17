<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="ar" dir="rtl" >
    <head>
        <?php
//require_once "./admin.php";
        $title = "لیست سوالات ";
        require_once "./headerAuthor.php";
        $packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);
        $courseId = filter_input(INPUT_GET, 'courseId', FILTER_SANITIZE_STRING);
        $result = getAllsoal($conn, $packageId);
        ?>
        <meta charset="UTF-8">
        <title><?php $title ?></title>
    </head>
    <body>
        <table class="table" style="margin-top: 20px">
            <tr>
                <th>شماره سوال </th>
                <th>عنوان سوال </th>
                <th>متن سوال</th>
                <th>جواب صحیح </th>
        <!--        <th>&nbsp;</th>-->
                <th>&nbsp;</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['qNo']; ?></td>
                    <td><?php echo $row['qTitle']; ?></td>
                    <td><?php echo $row['qText']; ?></td>
                    <td><?php echo $row['answer']; ?></td>
                    <td><a href="admin_deletesoal.php?packageId=<?php echo $row['packageId']; ?>&qId=<?php echo $row['qId']; ?>&courseId=<?php echo $courseId?>" onclick="return confirm('بعد از این عملیات سوال کلا حذف خواهند شد آیا مطمئن هستید؟')">حذف</a></td>
                    <td><a href="admin_editsource.php?packageId=<?php echo $row['packageId']; ?>&qId=<?php echo $row['qId']; ?>&courseId=<?php echo $courseId?>">ویرایش</a></td>
                    <?php
                    $packageId = $row['packageId'];
                    $_SESSION['packageId'] = $packageId;
                    ?>
                </tr>
            <?php } ?>

        </table>

        <br> 
        <div>   
                <a href="admin_package.php?courseId=<?php echo $courseId?>" >برگشت به صفحه لیست بسته ها</a>
        </div>
        <br>

    </body>
</html>
