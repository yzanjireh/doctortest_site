<?php

session_start();
$count = 0;
// connecto database
require_once "./functions/database_functionsp.php";
$conn = db_connect();
$packageId = filter_input(INPUT_GET, 'packageId', FILTER_SANITIZE_STRING);

$query = "SELECT * FROM Package" . $packageId;
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "مشکل در ارتباط با دیتا بیس " . mysqli_error($conn);
    exit;
}
$tests = array();


for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $query_row = mysqli_fetch_assoc($result);

    $tests[$i]['packageId'] = isset($query_row['packageId']) ? $query_row['packageId'] : '';
    $tests[$i]['qId'] = isset($query_row['qId']) ? $query_row['qId'] : '';

    $tests[$i]['qType'] = isset($query_row['qType']) ? $query_row['qType'] : '';

    $tests[$i]['qNo'] = isset($query_row['qNo']) ? $query_row['qNo'] : '';
    $tests[$i]['qTitle'] = isset($query_row['qTitle']) ? $query_row['qTitle'] : '';
    $tests[$i]['qText'] = isset($query_row['qText']) ? $query_row['qText'] : ''; //file_get_contents($image);
    $tests[$i]['qFig1'] = isset($query_row['qFig1']) ? $query_row['qFig1'] : '';
    $tests[$i]['qFig2'] = isset($query_row['qFig2']) ? $query_row['qFig2'] : '';
    $tests[$i]['qat'] = isset($query_row['qat']) ? $query_row['qat'] : '';

    $tests[$i]['qafig'] = isset($query_row['qafig']) ? $query_row['qafig'] : '';
    $tests[$i]['qbt'] = isset($query_row['qbt']) ? $query_row['qbt'] : '';
    $tests[$i]['qbfig'] = isset($query_row['qbfig']) ? $query_row['qbfig'] : '';
    $tests[$i]['qct'] = isset($query_row['qct']) ? $query_row['qct'] : ''; //file_get_contents($image);
    $tests[$i]['qcfig'] = isset($query_row['qcfig']) ? $query_row['qcfig'] : '';
    $tests[$i]['qdt'] = isset($query_row['qdt']) ? $query_row['qdt'] : '';
    $tests[$i]['qdfig'] = isset($query_row['qdfig']) ? $query_row['qdfig'] : '';

    $tests[$i]['answer'] = isset($query_row['answer']) ? $query_row['answer'] : '';
    $tests[$i]['qAns'] = isset($query_row['qAns']) ? $query_row['qAns'] : '';
    $tests[$i]['aFig1'] = isset($query_row['aFig1']) ? $query_row['aFig1'] : '';
    $tests[$i]['aFig2'] = isset($query_row['aFig2']) ? $query_row['aFig2'] : ''; //file_get_contents($image);
    $tests[$i]['qDesc'] = isset($query_row['qDesc']) ? $query_row['qDesc'] : '';

    $count++;
}
$testsJson = json_encode($tests);
echo $testsJson;

if (isset($conn)) {
    mysqli_close($conn);
}
?>