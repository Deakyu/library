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
        <div class="login-form">
            <form action="user-update.php" method="post">
                <div class="form-group">
                    <label for="username" class="form-control">Username:</label>
                    <input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $user['username'] ?>">
                </div>

                <div class="form-group">
                    <label for="pw" class="form-control">Password:</label>
                    <input type="password" name="pw" class="form-control">
                </div>

                <div class="form-group">
                    <label for="is_admin" class="form-control">Admin?</label>
                    <select name="is_admin" id="is_admin" class="form-control">
                        <option value="1">Administrator</option>
                        <option value="0">Visitor</option>
                    </select>
                </div>

                <input name="user_id" type="hidden" value="<?php echo $user['user_id'] ?>">

                <button type="submit" class="update-button">Update</button>
            </form>
        </div>
    </div>
</div>

<?php include "../includes/footer.php" ?>

