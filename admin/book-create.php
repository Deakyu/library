<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php $db = new DB(); ?>

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
                    <input type="date" class="form-control" name="date_of_publish" value="<?php echo date("Y-m-j") ?>">
                </div>

                <div class="form-group">
                    <label for="author" class="form-control">Author</label>
                    <input type="text" class="form-control" name="author">
                </div>

                <div class="form-group">
                    <label for="library_id" class="form-control">Library</label>
                    <select name="library_id" id="library_id" class="form-control">
                        <?php
                        $libraries = $db->getAllLibraries();
                        foreach($libraries as $library) {
                            echo "<option value=" . $library['library_id'] . ">" . $library['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="user_id" class="form-control">User</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <?php
                        $users = $db->getAllUsers();
                        foreach($users as $user) {
                            echo "<option value=" . $user['user_id'] . ">" . $user['username'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="store-button">Create</button>
            </form>
        </div>
    </div>
</div>

<?php include "../includes/footer.php" ?>

