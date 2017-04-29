<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
if(isset($_GET['book_id'])) {
    $book = $db->getBookById($_GET['book_id']);
} else {
    $book = false;
}

?>

<div class="container">
    <div class="login-form">
        <form action="book-update.php" method="post">
            <div class="form-group">
                <label for="title" class="form-control">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $book ? $book['title'] : "No Book found" ?>">
            </div>

            <div class="form-group">
                <label for="date_of_publish" class="form-control">Date Of Publish</label>
                <input type="date" class="form-control" name="date_of_publish" value="<?php echo $book['date_of_publish'] ?>">
            </div>

            <div class="form-group">
                <label for="author" class="form-control">Author</label>
                <input type="text" class="form-control" name="author" value="<?php echo $book ? $book['author'] : "No Book found" ?>">
            </div>

            <div class="form-group">
                <label for="library_id" class="form-control">Library Id</label>
                <input type="text" class="form-control" name="library_id" value="<?php echo $book ? $book['library_id'] : "No Book found" ?>">
            </div>

            <div class="form-group">
                <label for="user_id" class="form-control">User Id</label>
                <input type="text" class="form-control" name="user_id" value="<?php echo $book ? $book['user_id'] : "No Book found" ?>">
            </div>

            <input type="hidden" name="book_id" value="<?php echo $book ? $book['book_id'] : -1 ?>">

            <button type="submit">Update</button>
        </form>
    </div>
</div>

<?php include "../includes/footer.php" ?>

