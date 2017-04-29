<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
$db->createBook(
    $_POST['title'],
    $_POST['date_of_publish'],
    $_POST['library_id'],
    $_POST['author'],
    $_POST['user_id']
);
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/book-index.php');

?>
