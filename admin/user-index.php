<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "../db.php" ?>
<?php
    $db = new DB();
    $users = $db->getAllUsers();
?>

<ul>
    <?php
        foreach($users as $user) {
            echo "<li>" . $user['username'] . "</li>";
        }
    ?>
</ul>

<?php include "../includes/footer.php" ?>

