<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>

<div class="content">
    <div class="container">
        <div class="login-form">
            <form action="book-store.php" method="post">
                <div class="form-group">
                    <label for="title" class="form-control">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="form-group">
                    <label for="date_of_publish" class="form-control">Date Of Publish</label>
                    <input type="date" class="form-control" name="date_of_publish">
                </div>

                <div class="form-group">
                    <label for="author" class="form-control">Author</label>
                    <input type="text" class="form-control" name="author">
                </div>

                <div class="form-group">
                    <label for="library_id" class="form-control">Library Id</label>
                    <input type="text" class="form-control" name="library_id">
                </div>

                <div class="form-group">
                    <label for="user_id" class="form-control">User Id</label>
                    <input type="text" class="form-control" name="user_id">
                </div>

                <button type="submit">Create</button>
            </form>
        </div>
    </div>
</div>

<?php include "../includes/footer.php" ?>

