<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
if(isset($_GET['user_id'])) {
    $user = $db->getUserById($_GET['user_id']);
} else {
    $user = false;
}
?>

<div class="container">
    <table border="1" class="user-list-table">
        <tr>
            <td>ID</td>
            <td><?php echo $user ? $user['user_id'] : "No User Found" ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><?php echo $user ? $user['username'] : "No User Found" ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?php echo $user ? $user['pw'] : "No User Found" ?></td>
        </tr>
        <tr>
            <td>Admin?</td>
            <td><?php if($user) echo $user['is_admin'] == 1 ? 'Administrator' : 'Visitor' ?></td>
        </tr>
    </table>
</div>

<?php include "../includes/footer.php" ?>

