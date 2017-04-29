<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
$db->updateLibrary($_POST['library_id'], $_POST['name'], $_POST['add_street'], $_POST['add_city'], $_POST['add_state'], $_POST['add_zip']);
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/individual-library.php?library_id=' . $_POST['library_id']);



?>
