<!DOCTYPE html>
<html lang="FA" dir="RTL" >
    <head>
        <?php
        $title = "اخبار سایت";
        require_once "./header.php";
        ?>
        <script src="JSfiles/load_data.js" type="text/javascript"></script>
        <title>News</title>         
    </head>
    <body>  
        <div class="container" style="padding-top: 10px">
            <div class="row">
                <div class="well well-sm" style="background: green;color:white">
                    <h3>اخبار سایت</h3>
                </div>
                <br>
                <div id="results">
                    <?php include('result_data.php'); ?>
                </div>
                <div id="loader" style="text-align:center;"><img src="ajax_loader_blue_48.gif" /></div>
            </div>
        </div>
    </body>  

</html>  

