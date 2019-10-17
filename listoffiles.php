<?php
$PackFolder = filter_input(INPUT_GET, 'PackFolder', FILTER_SANITIZE_STRING);
//$PackFolder="docfiles/1078/soalat/";
$thelist=null;
 if ($handle = opendir($PackFolder)) {
   while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != "..") {
            $thelist = $thelist.$file.':';
            //$thelist = $thelist.$file."\r\n";
          }
       }
  closedir($handle);
  }
 echo $thelist;
?>