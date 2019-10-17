<div>
    <?php
    require_once './functions/database_functionsp.php';
    $conn = db_connect();

    $query = "SELECT * FROM `packages` WHERE courseId=" . $courseId ." ORDER BY packageNumber ASC";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "مشکل در ارتباط با دیتا بیس " . mysqli_error($conn);
        exit;
    }

    $num_record = mysqli_num_rows($result);
$query3 = "SELECT * FROM `coursebought` WHERE courseId=" . $courseId;

                    $result3 = mysqli_query($conn, $query3);
                    $num_record2 = mysqli_num_rows($result3);

    for ($i = 0; $i < $num_record; $i++) {
        $records = mysqli_fetch_assoc($result);
        $query_row = $records;
        $packageId = $query_row['packageId'];
        ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-centered"  style="border: solid; border-color: orange; margin:5px; padding:5px">                                
            <div class="parent" onclick="">
                <div class="child" style="background-image: url(<?php echo $query_row['packageUrl']; ?>);">
                    <?php
                    
                    if ($num_record2 > 0) {
                        ?>
                        <a href="loadpackage.php?packageId=<?php echo $query_row['packageId']; ?>&courseId=<?php echo $courseId?>" ><span class="span-op">امتیاز <?php echo $query_row['qbyusers'] ?> توضیحات بیشتر</span></a>
                        <?php
                    } else {
                        ?>
                        <div style="padding-top: -15px"><span class="span-op" style="color: orange">برای مشاهده محتویات بسته ها ثبت نام کنید</span> </div>
                        <!--<p style="display:inline;color: red"> برای مشاهده محتویات بسته ها ثبت نام کنید. </p>-->                                                                                                            
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div>
                <p><?php echo number2farsi($query_row['packageTitle']); ?></p>                                  
            </div> 
            
        </div>    
        <?php
    }
    if (isset($conn)) {
        mysqli_close($conn);
    }
    ?> 
</div>