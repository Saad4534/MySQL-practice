<?php

    // did the user's browser send a cookie for the session?
    if(isset($_COOKIE[session_name()])){
        // empty the cookie
        setcookie(session_name(),'',time()-86400,'/');
    }

    session_start();
    // clears all session variables
    session_unset();
    
    // destroy the session
    session_destroy();

    echo "You have been logged out! see you next time <br>";

    echo "<button class='btn btn-primary'><a href='login.php'>Log in back</a></button>"

?>