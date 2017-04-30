<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
if(isset($_GET['library_id'])) {
    $library = $db->getLibraryById($_GET['library_id']);
} else {
    $library = false;
}
?>

<div class="content">

    <div class="container">
        <table>
            <tr>
                <td>ID</td>
                <td><?php echo $library ? $library['library_id'] : "No library Found" ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $library ? $library['name'] : "No library Found" ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $library ? $library['add_street'] . ", " . $library['add_city'] . ", " . $library['add_state'] .  ", " . $library['add_zip'] : "No library Found" ?></td>
            </tr>
            <tr>
                <td><a href="/admin/library-edit.php?library_id=<?php echo $library['library_id'] ?>"><button>Edit</button></a></td>
                <td><a href="/admin/library-delete.php?library_id=<?php echo $library['library_id'] ?>"><button class="delete-button">Delete</button></a></td>
            </tr>
        </table>
    </div>
</div>

<?php include "../includes/footer.php" ?>

