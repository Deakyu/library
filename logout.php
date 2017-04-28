<?php include "session-start.php"; ?>
<?php include "login-middleware.php" ?>
<?php
    $_SESSION['login-status'] = false;
    $_SESSION['user'] = false;
    header('Location: index.php');
?>