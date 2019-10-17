<?php
session_start();

if (!$_SESSION['email']) {
    header("Location: index.php"); //redirect to login page to secure the welcome page without login access.  
}
?>  

<html>  

    <head>    
        <title>  
            ثبت نام  
        </title>  
    </head>  

    <body dir="rtl">  
        <h1>خوش آمدید </h1><br>  
        <?php
        echo $_SESSION['email'];
        ?>  


        <h1><a href="logout.php"> با کلیک در این قسمت خارج شوید</a> </h1>  


    </body>  

</html>

