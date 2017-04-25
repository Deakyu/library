<?php include "session-start.php"; ?>
<?php
    if($_SESSION['login-status']) {
        $_SESSION['login-status'] = false;
        unset($_SESSION['user_id']);
        header('Location: login.php');
    }
?>