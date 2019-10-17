<?php
            $email = filter_input(INPUT_POST, "inputEmail"); //$_POST['email'];//same  
            $pswd = filter_input(INPUT_POST, "inputPasswd"); //$_POST['pass'];//same
$conn= db_connect();
if (!$conn) {
    echo "نمی تواند به دیتا بیس وصل شود " . mysqli_connect_error($conn);
    exit;
}

$query = "SELECT name, passw FROM admin";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Empty!";
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {
    if ($email == $row['name'] && $pswd == $row['pass']) {
        echo "ادمین عزیز خوش آمدید.";
        break;
    }
}
?>