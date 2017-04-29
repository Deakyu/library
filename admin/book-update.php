<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
$db->updateBook(
    $_POST['book_id'],
    $_POST['title'],
    $_POST['date_of_publish'],
    $_POST['author'],
    $_POST['library_id'],
    $_POST['user_id']
);
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/individual-book.php?book_id=' . $_POST['book_id']);



?>
