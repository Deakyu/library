<?php include "session-start.php" ?>
<?php include "includes/header.php" ?>
<form action="authenticate.php" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username">
    </div>

    <div>
        <label for="pw">Password:</label>
        <input type="password" name="pw">
    </div>

    <button type="submit">Submit</button>
</form>

<?php include "includes/footer.php" ?>
