<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php 
        include_once './functions/database_functionsp.php';
        ?>
        <title></title>
    </head>
    <body>
        <?php
        
        require_once 'logindb.php';
    $conn = mysqli_connect($hn, $un, $pw, $db);
    if(!$conn) die(mysql_fatal_error());
        $aa=select4LatestPackage($conn);
                
        $test="<p>this is for test </p>";
        echo $test;
        
        $test2=htmlspecialchars($test);
        print_r($test2);
        
        // put your code here
        ?>
    </body>
</html>
