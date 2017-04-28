<?php include "session-start.php" ?>
<?php include "includes/header.php" ?>
<div class="login-form">
    <form action="authenticate.php" method="post">
        <div class="form-group">
            <label for="username" class="form-control">Username:</label>
            <input type="text" name="username" class="form-control" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="pw" class="form-control">Password:</label>
            <input type="password" name="pw" class="form-control">
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<?php include "includes/footer.php" ?>
