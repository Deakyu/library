<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php
    $db = new DB();
    $users = $db->getAllUsers();
?>

<div class="content">

    <div class="container">

        <ul>
            <?php
            foreach($users as $user) {
                echo "<li><a href='individual-user.php?user_id=" . $user['user_id'] . "'>" . $user['username'] . "</a>";
            }
            ?>
        </ul>
        <a href="user-create.php"><button>Create User</button></a>
    </div>
</div>

<?php include "../includes/footer.php" ?>

