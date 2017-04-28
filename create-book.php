<?php include "session-start.php" ?>
<?php include "login-middleware.php" ?>
<?php include "includes/header.php"; ?>

<form action="store-book.php" method="post">
    <label>
        title
        <input type="text" name="title">
    </label>

    <label>
        date
        <input type="date" name="date_of_publish">
    </label>

    <input type="hidden" value="1" name="author_id">
    <input type="hidden" value="<?php echo available ?>" name="user_id">
    <input type="hidden" value="1" name="library_id">
    <button type="submit">submit</button>
</form>

<?php include "includes/footer.php"; ?>
