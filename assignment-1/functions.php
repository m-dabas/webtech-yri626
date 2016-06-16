<?php


function destroySession()
{
    $_SESSION=array();
    //$_SESSION = [];
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

?>

