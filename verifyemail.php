<!DOCTYPE html>
<html lang="FA" dir="RTL">
    <head>
        <?php
        require_once "./header.php";
        ?>
        <title>تایید ایمیل</title>  
    </head>  
    <body>  

        <?php
        $verifysql = new mysqli;
        
        $verifysql->connect('localhost', 'dbdr', 'Valdian#2377', 'dbdrtest'); //$host, $user, $password, $database, $port, $socket);
        //mysql_select_db("dbdrtest") or die(mysql_error()); // Select registration database. 
        if (isset($_GET["email"]) && !empty($_GET["email"]) AND isset($_GET["hash"]) && !empty($_GET["hash"])) {
// Verify data
//$name = mysql_escape_string($_GET['username']); // set name variable

            $email = $verifysql->escape_string(filter_input(INPUT_GET, "email")); // Set email variable 
            $hash = $verifysql->escape_string(filter_input(INPUT_GET, "hash")); // Set hash variable
//$Salt = mysql_escape_string($_GET['pwpass']); // set pwpass variable

            $search = $verifysql->query("SELECT email, hash, active, emailmoaref FROM users WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysql_error());
            $row = $search->fetch_assoc();
$emailmoaref=$row["emailmoaref"];
        
            $match = $search->num_rows;
// echo $match; // Display how many matches have been found -> remove this when done with testing ;)	
            if ($match > 0) {
// We have a match, activate the account
                $verifysql->query("UPDATE users SET active='1' WHERE email='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysql_error());
                $verifysql->query("UPDATE users SET emtiaz = emtiaz + 10 WHERE `email`='".$emailmoaref."'");
// export to table users_pw
//mysql_query("call adduser('$name', $Salt, '0', '0', '0', '0', '$email', '0', '0', '0', '0', '0', '0', '0', '', '', $Salt)") or die ("Can't execute query.");
                echo '<div class="statusmsg">حساب کاربری شما فعال گردید می توانید وارد شوید</div>';?>
                <script>setTimeout(function () {
                    window.location.href = "/login.php"
                }, 5000);</script>

            <h2>بعد از پنج ثانیه به صفحه ورود به  سایت برمی گردید</h2>
            <h2><a href="http://doctortest.ir/login.php">بازگشت به صفحه ورود </a></h2>
            <?php
            } else {
// No match -> invalid url or account has already been activated.
                echo '<div class="statusmsg">لینک معتبر نمی باشد و یا شما قبلا فعال سازی را انجام داده اید</div>';?>
            <script>setTimeout(function () {
                    window.location.href = "/"
                }, 5000);</script>

            <h2>بعد از پنج ثانیه به صفحه اصلی سایت برمی گردید</h2>
            <h2><a href="http://doctortest.ir/">بازگشت به صفحه اصلی </a></h2>
            <?php
            }?>
            
       <?PHP }
        require_once "./footer.php";

        $verifysql->close();
        ?>
    </body>
</html>