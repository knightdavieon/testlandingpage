<?php
session_start(); // Start the session

// Destroy all session data
session_unset();
session_destroy();

// Optionally, you can clear cookies if you use cookies for session handling
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to the login page or home page
header("Location: ../../"); // Replace 'login.php' with your actual login page or home page
exit();
?>
