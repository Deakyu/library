<?php include "session-start.php"; ?>
<?php include "login-middleware.php" ?>
<?php
    include "db.php";
    if(isset($_GET['book_id'])) {
        $db = new DB();
        $book = $db->getBookById($_GET['book_id']);
        $db->rentBook($_GET['book_id'], $_SESSION['user']['user_id']);
        header('Location: individual-library.php?id=' . $book['library_id']);
    }

?>