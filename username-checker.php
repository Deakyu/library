<?php

include "db.php";
$db = new DB();

if(isset($_POST['username'])) {
    echo $userValidation = $db->checkUsername($_POST['username']);
}

?>