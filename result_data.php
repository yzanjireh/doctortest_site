<?php

require_once './functions/database_functionsp.php';
$conn = db_connect();
$perPage = 4;
$sql_query = "SELECT * FROM news";
$page = 1;
if (!empty($_GET["page"])) {
    $page = $_GET["page"];
}
$start = ($page - 1) * $perPage;
if ($start < 0)
    $start = 0;
$query = $sql_query . " limit " . $start . "," . $perPage;
$resultset = mysqli_query($conn, $query) or die("database error:" . mysqli_error($conn));
$records = mysqli_fetch_assoc($resultset);
if (empty($_GET["total_record"])) {
    $_GET["total_record"] = mysqli_num_rows($resultset);
}
$message = '';
if (!empty($records)) {
    $message .= '<input type="hidden" class="page_number" value="' . $page . '" />';
    $message .= '<input type="hidden" class="total_record" value="' . $_GET["total_record"] . '" />';
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $message .= '<div class="well"><b>' . $rows["newstitle"] . '</b><br>' . $rows["newstext"] . '<br>' . $rows["newsdate"] . '</div>';
    }
}
echo $message;
?>