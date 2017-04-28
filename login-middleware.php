<?php
    if(!$_SESSION['login-status'] && $page != 'index') {
        header('Location: index.php');
    }

?>
