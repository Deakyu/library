<?php include "session-start.php"; ?>
<?php
    if($_SESSION['login-status']) {
        $_SESSION['login-status'] = false;
        $_SESSION['user'] = false;
        header('Location: login.php');
    }
?>