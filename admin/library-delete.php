<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../db.php" ?>
<?php
if(isset($_GET['library_id'])) {
    $db = new DB();
    $db->deleteLibraryById($_GET['library_id']);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/library-index.php');
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/library-index.php');
}

?>
