<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
$db->updateUser($_POST['user_id'], $_POST['username'], $_POST['pw'], $_POST['is_admin']);
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/individual-user.php?user_id=' . $_POST['user_id']);



?>
