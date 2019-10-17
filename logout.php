<?php
destroy_session_and_data();
header("Location: index.php"); //use for the redirection to some page  

function destroy_session_and_data() {
    session_start();
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}
?>  