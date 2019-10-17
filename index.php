<!DOCTYPE html>
<!--this site is designed by Intellogent training company for Doctortest.ir-->
<html lang="FA" dir="RTL">
    <head>        
        <?php
        require_once './header.php';
        ?>
        <title>دوره های آموزشی دکتر تست</title>       
        <script type="text/javascript">
            $('document').ready(function () {
                $('.carousel').carousel({
                    interval: 5000
                })
            });
                </script>
<!--<script>
        $(document).ready(function () {
            $("#filter-categorya :checkbox").click(function () {
                $("#filter-categorya :checkbox:checked").each(function () {                                
                        window.alert("it's activated");
                    $("#filter-categorya").load("courseFilter.php", {q: 'کنکور'});
                });        
            });
        });
    </script>-->
    </head>
    <body>

        <input class="hidden-sm hidden-xs" onclick="topFunction()" type="image" width="48" height="48" src="circle_arrow_up.png" id="myBtn" alt="submit">
        <div class="container-fluid">
            <div class="row">
                <?PHP
                if (isset($_SESSION['LAST_ACTIVITY']) && (time() - htmlentities($_SESSION['LAST_ACTIVITY']) > 1800)) {
                    // last request was more than 30 minutes ago
                    $session_unset = session_unset();     // unset $_SESSION variable for the run-time 
                    $session_destroy = session_destroy();   // destroy session data in storage
                }
                $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

                if (!isset($_SESSION['CREATED'])) {
                    $_SESSION['CREATED'] = time();
                } else if (time() - $_SESSION['CREATED'] > 1800) {
                    // session started more than 30 minutes ago
                    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
                    $_SESSION['CREATED'] = time();  // update creation time
                }
                $temp = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
                $courseId = filter_input(INPUT_GET, 'courseId', FILTER_SANITIZE_STRING);
                $courseType = filter_input(INPUT_GET, 'courseType', FILTER_SANITIZE_STRING);

                if (isset($temp) && $temp === "addtocart") {
                    if (isset($courseId)) {
                        // new iem selected
                        if (!isset($_SESSION['cart'])) {
                            // $_SESSION['cart'] is associative array that courseId => qty                
                            $_SESSION['cart'] = array();
                            $_SESSION['total_items'] = 0;
                            $_SESSION['total_price'] = '0.00';
                        }
                    }
                    $test = false;
                    foreach (htmlentities($_SESSION['cart']) as $key => $value) {
                        if ($courseId == $value['courseId']) {
                            $test = true;
                        }
                    }
                    if (!$test) {
                        // if(!empty($_POST["quantity"])) {      
                        $res=getcourseById($conn, $courseId);
                        $_SESSION['cart'][] = mysqli_fetch_assoc($res);
                        $_SESSION['total_price'] = htmlentities($_SESSION['total_price']) + getcourseprice($courseId);
                        $string = ' بسته' . $courseId . '   به سبد اضافه شد';
                        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>توجه:</strong> ' . $string . '</div>';
                        mysqli_close($res);
                    } else {
                        $string = ' بسته' . $courseId . ' قبلا انتخاب شده است';
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>توجه:</strong> ' . $string . '</div>';
                    }
                }
                ?>

                <div class='Header jumbotron text-center' style="background: wheat;padding: 0.3em;margin:10px">
                    <h1 style="color: green"> هر روز و در هر جا، آنلاین و آفلاین روی گوشی خود درس بخوانید، تست بزنید و خودتان را با سایر شرکت کنندگان مقایسه کنید.</h1>
                    <!--<h2>با بهره گیری از روشهای نوین، ما بهترین ایده ها را برای بهبود روند رشد شما به کار خواهیم گرفت.</h2>-->	
                    <a href='https://play.google.com/store/apps/details?id=ir.doctortest.doctortest&hl=en&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='دانلود از گوگل پلی' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' style="width:330px; height:110px;"/></a>
                    <h2 style="font-weight: bold">نرم افزار دکتر تست را بر روی گوشی خود نصب نمایید.</h2>					
                </div>

                <div class="hidden-lg hidden-md col-sm-12 col-xs-12">
                    <div class="well well-ms" style="background: green; margin:10px">
                        <a href="./courses.php">
                            <h1 style="text-align: center;color:white"> لیست دوره ها</h1>
                        </a>
                    </div>
                    <div id="carsitems" >
                        <?php include('courseFilter.php'); ?>
                        <!--<script type="text/javascript">
                            $(document).ready(function () {
                            $("#new_items").load("courseFilter.php", {q: '
                        <?php //echo $q  ?>'});
                            });
                        </script>-->
                    </div>
                    <!--<div id="loader" style="text-align:center;"><img src="ajax_loader_blue_48.gif" /></div>-->
                </div>


                <div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >                        
                        <div class="quandanswers" style="text-align: center; margin-bottom: 0.3em; background: red; border-radius: 0.3em;">
                            <a href="questionsandanswers.php"><h1 style="color: white;">
                                    سوالات و جواب های کاربران
                                    <br>
                                    کلیک کنید
                                    <span class="glyphicon glyphicon-question-sign"></span></h1>
                            </a>
                        </div>
                        <!--<div class="panel-primary" style="border-radius: 0.3em;">
                            <div class="panel-heading" style=" border-radius: 0.3em;background-color: blue">                                
                                <h1 style="text-align: center">فیلتر  دوره ها<span class="glyphicon glyphicon-filter"></span></h1>
                            </div>
                            <div class="panel-body" style="border:3px solid blue ;  border-radius: 0.3em;">
                                <h2 style="color:red">زبان</h2>
                                <ul>
                                    <li>
                                        <input type="checkbox" value="zabanpayeh" id="filter-payeh" />
                                        <label for="filter-payeh"> زبان پایه</label>
                                        <ul> 
                                            <li>
                                                <input type="checkbox" value="zabanpayeh" id="filter-payeh1" />
                                                <label for="filter-payeh1">ابتدایی </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="zabanpayeh" id="filter-payeh2" />
                                                <label for="filter-payeh2">  متوسطه</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="zabanpayeh" id="filter-payeh3" />
                                                <label for="filter-payeh3">  پیشرفته</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="zabanpayeh" id="filter-payeh4" />
                                                <label for="filter-payeh4"> فوق پیشرفته</label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="konkoursarasari" id="filter-categorya" />
                                        <label for="filter-categorya"> زبان کنکور سراسری</label>
                                        <ul> 
                                            <li id="filters">
                                                <input type="checkbox" value="konkoursarasari" id="filter-categorya1" />
                                                <label for="filter-categorya1"> رشته تجربی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categorya2" />
                                                <label for="filter-categorya2"> رشته ریاضی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categorya3" />
                                                <label for="filter-categorya3"> رشته انسانی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categorya4" />
                                                <label for="filter-categorya4"> سایر رشته ها</label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="konkoursarasari" id="filter-categorb" />
                                        <label for="filter-categoryb"> زبان کنکور کارشناسی ارشد</label>
                                        <ul> 
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryb1" />
                                                <label for="filter-categoryb1"> رشته های فنی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryb2" />
                                                <label for="filter-categoryb2"> رشته های علوم پایه</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryb3" />
                                                <label for="filter-categoryb3"> رشته های انسانی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryb4" />
                                                <label for="filter-categoryb4"> رشته های دیگر</label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="konkoursarasari" id="filter-categorc" />
                                        <label for="filter-categoryc">زبان کنکور دکتری </label>
                                        <ul> 
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryc1" />
                                                <label for="filter-categoryc1"> رشته های فنی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryc2" />
                                                <label for="filter-categoryc2"> رشته های علوم پایه</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryc3" />
                                                <label for="filter-categoryc3"> رشته های انسانی</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" value="konkoursarasari" id="filter-categoryc4" />
                                                <label for="filter-categoryc4"> رشته های دیگر</label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <input type="checkbox" value="ielts" id="filter-ielts" />
                                        <label for="filter-ielts">آزمون IELTS  </label>
                                    </li>
                                      <li>
                                        <input type="checkbox" value="toefl" id="filter-toefl" />
                                        <label for="filter-toefl">آزمون TOEFL  </label>
                                    </li>

                                    <li>
                                        <input type="checkbox" value="rahnemayiranandegi" id="filter-categoryd" />
                                        <label for="filter-categoryd">  راهنمایی رانندگی </label>
                                    </li>    

                                    <li>
                                        <input type="checkbox" value="estekhdami" id="filter-categorye" />
                                        <label for="filter-categorye">  آزمونهای استخدامی </label>
                                    </li>    

                                    <li>
                                        <input type="checkbox" value="nezammoahandesi" id="filter-categoryf" />
                                        <label for="filter-categoryf">  آزمونهای نظام مهندسی </label>
                                    </li>    

                                    <li>
                                        <input type="checkbox" value="azemoondadgostari" id="filter-categoryg" />
                                        <label for="filter-categoryg">  آزمونهای کارشناس دادگستری </label>
                                    </li>    
                                    <li>
                                        <input type="checkbox" value="amoozeshi" id="filter-categoryc" />
                                        <label for="filter-categoryc"> کتابها و دوره های آموزشی</label>
                                    </li>    
                                </ul>
                            </div>
                        </div>-->
                        <div class="jumbotron" style="padding: 0.3em; margin-top: 0.3em;margin-bottom: 0px; background-color: #0000ff;color: #fbfcf9; border-radius: 0.3em;">
                            <h2 style="text-align: center">سوال خود را بپرسید:</h2>
                            <p>در این بخش شما می توانید سوال خود را بپرسید و به سوالات دیگران پاسخ دهید.</p>
                            <p>سوالها و جوابها به نام خودتان ثبت خواهد شد.</p>
                            <p>هر کدام از جوابها مورد ارزیابی دیگران قرار خواهد گرفت.</p>
                            <div style="text-align: center;margin: 0.6em"><a href="./askquestion.php" class="btn-success btn-lg center-block"><h3>طرح سوال</h3><span class="glyphicon glyphicon-question-sign center-block"></span></a></div>
                        </div>
                        <div class="panel-primary hidden-sm hidden-xs" style="padding: 0.3em; margin-top: 0.3em;border-radius: 0.3em;">                          
                            <div class="panel-heading" style=" border-radius: 0.3em;background-color: green">                                
                                <a href="./news.php" style=" text-align: center;border-radius: 0.3em;background-color: green" class="btn-primary btn-lg center-block"><h3> اخبار سایت</h3></a>
                            </div>
                            <div class="panel-body" style="border:0.2em solid green ;  border-radius: 0.3em;">
                                <div id="news_item"> 
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $("#news_item").change();
                                        });
                                        $(document).ready(function () {
                                            $("#news_item").load("news_load.php");
                                        });
                                    </script>
                                </div>                                
                            </div>
                        </div>
                        
                        <!--<div class="jumbotron center-block hidden-sm hidden-xs" style="margin: 0.3em; background-color:#9df39f ">
                        <h1>محل تبلیغ شما</h1>
                        <h2>با ادمین سایت تماس بگیرید</h2>                            
                    </div>-->                                               
                    </div>

                    <div id="carsitems" class="col-lg-9 col-md-9 hidden-sm hidden-xs">
                        <div class="col-md-12">
                            <div class="well well-ls clearfix" style="padding: 0px;margin-bottom: 0px;text-align: center;background: #FFE300"><h1>جدیدترین دوره ها</h1> </div>
                            <div class="well">
                                <div id="myCarousel" class="carousel slide">
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel carousel-inner">
                                        <div class="item active">
                                            <div id="new_items" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#new_items").load("courses_load_new.php?test=1");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div id="new_items2" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#new_items2").load("courses_load_new.php?test=2");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div id="new_items3" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#new_items3").load("courses_load_new.php?test=3");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                    <a class="left carousel-control" href="#myCarousel" data-slide="next">›</a>
                                </div>
                            </div>  
                        </div>
                        <div class="clearfix visible-xs-block"></div>

                        <div class="col-md-12">
                            <div class="well well-ls clearfix" style="padding: 0px;margin-bottom: 0px;text-align: center;background: #FFE300"><h1>بیشترین دوره های ثبت نام شده</h1> </div>
                            <div class="well"> 
                                <div id="myCarousel2" class="carousel slide">
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel2" data-slide-to="1"></li>
                                        <li data-target="#myCarousel2" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel carousel-inner">
                                        <div class="item active">
                                            <div id="top_items" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#top_items").load("courses_load_top.php?test=1");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div id="top_items2" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#top_items2").load("courses_load_new.php?test=2");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div id="top_items3" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#top_items3").load("courses_load_new.php?test=3");
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="right carousel-control" href="#myCarousel2" data-slide="prev">‹</a>
                                    <a class="left carousel-control" href="#myCarousel2" data-slide="next">›</a>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix visible-xs-block"></div>
                        <div class="col-md-12">
                            <div class="well well-ls clearfix" style="padding: 0px;margin-bottom: 0px;text-align: center;background: #FFE300"><h1>محبوب ترین دوره ها</h1></div>
                            <div class="well"> 
                                <div id="myCarousel3" class="carousel slide">
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel3" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel3" data-slide-to="1"></li>
                                        <li data-target="#myCarousel3" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Carousel items -->
                                    <div class="carousel carousel-inner">
                                        <div class="item active">
                                            <div id="best_items" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#best_items").load("courses_load_best.php?test=1");
                                                    });
                                                </script>
                                            </div><!--/row-fluid-->
                                        </div><!--/item-->

                                        <div class="item">
                                            <div id="best_items2" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#best_items2").load("courses_load_best.php?test=2");
                                                    });
                                                </script>
                                            </div><!--/row-fluid-->
                                        </div><!--/item-->

                                        <div class="item">
                                            <div id="best_items3" class="row">
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#best_items3").load("courses_load_best.php?test=3");
                                                    });
                                                </script>
                                            </div><!--/row-fluid-->
                                        </div><!--/item-->
                                    </div><!--/carousel-inner-->
                                    <a class="right carousel-control" href="#myCarousel3" data-slide="prev">‹</a>
                                    <a class="left carousel-control" href="#myCarousel3" data-slide="next">›</a>
                                </div><!--/myCarousel-->
                            </div><!--/well-->   
                            <div class="well well-ls clearfix" style="padding: 0px;margin-bottom: 0px;text-align: center;background: #FFE300"><h1>فلوچارت کار با سامانه آزمونهای دکتر تست</h1> </div>
                            <div id="flow_chart" style="text-align: center;background: #F8F8F8">
                                <img src="flowchart.jpg" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
        <div style="padding:.5em">
                     

        </div>
        <script>
// When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function () {
                scrollFunction()
            };
            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("myBtn").style.display = "block";
                } else {
                    document.getElementById("myBtn").style.display = "none";
                }
            }

// When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>   
        
    </body>

<?php
require_once "./footer.php";
?>