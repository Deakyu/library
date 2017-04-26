<?php include "session-start.php" ?>
<?php
    include "db.php";
    $db = new DB();
    if($db->authenticate($_POST['username'], $_POST['pw'])) {
        $_SESSION['user'] = $db->getUserById($db->getUserId($_POST['username']));
        $_SESSION['login-status'] = true;
        header('Location: index.php');
    } else {
        $_SESSION['user'] = false;
        $_SESSION['login-status'] = false;
        header('Location: login.php');
    }

?>