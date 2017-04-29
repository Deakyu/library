<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
if(isset($_GET['user_id'])) {
    $db = new DB();
    $db->deleteUserById($_GET['user_id']);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/user-index.php');
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/user-index.php');
}

?>
