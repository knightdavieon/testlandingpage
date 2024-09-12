<?php session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['email'])) {
    $_SESSION['triedToAccess'] = true;
    $_SESSION['loggedIn'] = false;

    
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    redirect('../');
}
?>