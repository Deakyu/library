<?php include "session-start.php" ?>
<?php
    include "db.php";

    $db = new DB();

    $user = $db->getUserById($_SESSION['user_id']);

    echo $user['username'];

?>