<?php include "session-start.php" ?>
<?php include "login-middleware.php" ?>
<?php include "db.php" ?>
<?php
$db = new DB();

$db->createBook(
        $_POST['title'],
        $_POST['date_of_publish'],
        $_POST['library_id'],
        $_POST['author_id'],
        $_POST['user_id']
    );

header("Location: create-book.php");

?>
