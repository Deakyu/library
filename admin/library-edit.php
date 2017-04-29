<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
if(isset($_GET['library_id'])) {
    $library = $db->getLibraryById($_GET['library_id']);
} else {
    $library = false;
}

?>

<div class="container">
    <div class="login-form">
        <form action="library-update.php" method="post">
            <div class="form-group">
                <label for="name" class="form-control">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $library ? $library['name'] : "No Library found" ?>">
            </div>

            <div class="form-group">
                <label for="add_street" class="form-control">Street</label>
                <input type="text" class="form-control" name="add_street" value="<?php echo $library ? $library['add_street'] : "No Library found" ?>">
            </div>

            <div class="form-group">
                <label for="add_city" class="form-control">City</label>
                <input type="text" class="form-control" name="add_city" value="<?php echo $library ? $library['add_city'] : "No Library found" ?>">
            </div>

            <div class="form-group">
                <label for="add_state" class="form-control">State</label>
                <input type="text" class="form-control" name="add_state" value="<?php echo $library ? $library['add_state'] : "No Library found" ?>">
            </div>

            <div class="form-group">
                <label for="add_zip" class="form-control">Zip Code</label>
                <input type="text" class="form-control" name="add_zip" value="<?php echo $library ? $library['add_zip'] : "No Library found" ?>">
            </div>

            <input type="hidden" name="library_id" value="<?php echo $library ? $library['library_id'] : -1 ?>">


            <button type="submit">Update</button>
        </form>
    </div>
</div>

<?php include "../includes/footer.php" ?>

