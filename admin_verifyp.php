<?php

session_start();

require_once "./headerAuthor.php";

if (!isset($_POST['submit'])) {
    echo "Something wrong! Check again!";
    exit;
}
require_once "./functions/database_functionsp.php";

$conn = db_connect();

$email = trim($_POST['email']);
$pass = trim($_POST['pass']);

if ($email == "" || $pass == "") {
    echo "email or Pass is empty!";
    exit;
}

$email = mysqli_real_escape_string($conn, $email);
$pass = mysqli_real_escape_string($conn, $pass);

$pass = password_hash($pass, PASSWORD_DEFAULT);// new method to securly hash password

//$pass = sha1($pass);

// get from db
$query = "SELECT email, pass from authors";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Empty data " . mysqli_error($conn);
    exit;
}
$row = mysqli_fetch_assoc($result);


if ($email != $row['email'] || !password_verify($pass, $row['pass'])) {

    echo "Name or pass is wrong. Check again!";

    $_SESSION['admin'] = false;
    header("Location: admin.php");
    exit;
}

if (isset($conn)) {
    mysqli_close($conn);
}
$_SESSION['admin'] = $email;
header("Location: admin_package.php");
exit;
?>