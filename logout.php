<?php include "session-start.php"; ?>
<?php
    $_SESSION['login-status'] = false;
    $_SESSION['user'] = false;
    header('Location: login.php');
?>