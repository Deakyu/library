<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
if(isset($_GET['book_id'])) {
    $db = new DB();
    $db->deleteBookById($_GET['book_id']);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/book-index.php');
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/book-index.php');
}

?>
