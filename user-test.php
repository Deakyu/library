<?php include "session-start.php" ?>
<?php
    include "db.php";

    $db = new DB();

    if($db->authenticate('user1', 'pw1')) {
        echo "success";
    } else {
        echo "fail";
    }

?>