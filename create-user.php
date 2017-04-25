<?php include "session-start.php" ?>
<?php
    include "db.php";
    $db = new DB();


    $db->createUser($_POST['username'], $_POST['pw']);
    header('Location: index.php');




?>