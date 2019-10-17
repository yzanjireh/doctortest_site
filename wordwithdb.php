<?php

require_once 'logindb.php';
require_once "./functions/database_functionsp.php";

//$conn = new mysqli($hn, $un, $pw, $db);
$conn = mysqli_connect($hn, $un, $pw, $db);
if ($conn->connect_error)
    die(mysql_fatal_error());

$user_email = "yzanjireh@gmail.com";
$user_pass = "987654321";
$user_pass = mysql_entities_fix_string($conn, $user_pass);
$user_email = mysql_entities_fix_string($conn, $user_email);

$user_pass=password_hash($user_pass, PASSWORD_DEFAULT);

//$user_pass = sha1($user_pass);

$check_user = "select * from users WHERE email='$user_email' AND password='$user_pass' AND active=1";

$result = mysqli_query($conn, $check_user);

$rows = mysqli_num_rows($result);

//$row = mysqli_fetch_assoc($result);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


$_SESSION['userId'] = isset($row['userId']) ? $row['userId'] : '';
$_SESSION['name'] = isset($row['name']) ? $row['name'] : '';
$_SESSION['sname'] = isset($row['sname']) ? $row['sname'] : '';
$_SESSION['userphotoUrl'] = isset($row['userphotoUrl']) ? $row['userphotoUrl'] : '';




$stmt = $conn->prepare('INSERT INTO `users`(`userId`, `branchId`, `password`, `name`, `sname`, `email`, `cellNumber`, `hash`, `active`, `emtiaz`, `emailmoaref`, `userphotoUrl`, `userDateTime`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
$stmt->bind_param('iissss', $userId, $branchId, $password, $name, $sname);

//i: The data is an integer.
//d: The data is a double.
//s: The data is a string.
//b: The data is a BLOB (and will be sent in packets).

$stmt->execute();

printf("%d Row inserted.\n", $stmt->affected_rows);
$stmt->close();
$conn->close();
?>