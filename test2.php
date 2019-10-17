<?php
    $qFig1 = "null";
        //$qFig1 = "admin";

    if(!($qFig1==="null")){
    $qFig1="'".$qFig1."'";
}
    $qFig1="COALESCE(" . $qFig1 . ",`qFig1`)";

            require_once "./functions/database_functionsp.php";
    $conn=db_connect();
    $qyery2="select " . $qFig1 . " from packages;";
    $result=mysqli_query($conn,$qyery2);
    
    $query="select * from packages where `packageAuthor`=COALESCE(" . $qFig1 . ",`packageAuthor`)";
    echo $query;
    $res=mysqli_query($conn,$query);
    echo error_reporting();
    $row=mysqli_fetch_assoc($res);
    echo $row['packageNumber'];
    echo 'test';
    ?>
    
