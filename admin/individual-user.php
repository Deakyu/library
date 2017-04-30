<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
if(isset($_GET['user_id'])) {
    $user = $db->getUserById($_GET['user_id']);
} else {
    $user = false;
}
?>

<div class="content">

    <div class="container">
        <table>
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
            <tr>
                <td><a href="/admin/user-edit.php?user_id=<?php echo $user['user_id'] ?>"><button>Edit</button></a></td>
                <td><a href="/admin/user-delete.php?user_id=<?php echo $user['user_id'] ?>"><button class="delete-button">Delete</button></a></td>
            </tr>
        </table>
    </div>
</div>

<?php include "../includes/footer.php" ?>

