<?php
if(!isset($_SESSION['user']) || !$_SESSION['user']['is_admin']) {
    header('Location: http://' . $_SERVER['HTTP_HOST']);
}

?>