<?php include "session-start.php" ?>
<?php include "includes/header.php" ?>


<div class="login-form">
    <form action="create-user.php" method="post">
        <div class="form-group">
            <label for="username" class="form-control">Username:</label>
            <input type="text" id="username" name="username" class="form-control" autocomplete="off">
            <div id="user-result"></div>
        </div>

        <div class="form-group">
            <label for="pw" class="form-control">Password</label>
            <input type="password" name="pw" class="form-control">
        </div>

        <button type="submit">Register!</button>
    </form>
</div>
<?php include "includes/username-check.php" ?>
<?php include "includes/footer.php" ?>
