<?php
    session_start();

    // constant number for user_id in book
    // -> indicates that the book is available(not rented yet)
    const available = -1;
    if(!isset($_SESSION['login-status'])) {
        $_SESSION['login-status'] = false;
    }


?>