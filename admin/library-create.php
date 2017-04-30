<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>

<div class="content">
    <div class="container">
        <div class="login-form">
            <form action="library-store.php" method="post">
                <div class="form-group">
                    <label for="name" class="form-control">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label for="add_street" class="form-control">Street</label>
                    <input type="text" class="form-control" name="add_street">
                </div>

                <div class="form-group">
                    <label for="add_city" class="form-control">City</label>
                    <input type="text" class="form-control" name="add_city">
                </div>

                <div class="form-group">
                    <label for="add_state" class="form-control">State</label>
                    <input type="text" class="form-control" name="add_state">
                </div>

                <div class="form-group">
                    <label for="add_zip" class="form-control">Zip Code</label>
                    <input type="text" class="form-control" name="add_zip">
                </div>


                <button type="submit" class="store-button">Create Library</button>
            </form>
        </div>
    </div>
</div>

<?php include "../includes/footer.php" ?>

