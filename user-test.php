<?php include "session-start.php" ?>
<?php include "login-middleware.php" ?>

<?php
    include "db.php";

    $db = new DB();

    echo $_SESSION['user']['username'];

?>