<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $answer = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_STRING);
    $qId = filter_input(INPUT_GET, 'qId', FILTER_SANITIZE_STRING);

    if($answer!=null)
        $GLOBALS[$qId]=$answer;
    $qId=$qId+1;

    header("Location: loadpackage.php");
exit;
       
    
