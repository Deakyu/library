<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
$libraries = $db->getAllLibraries();
?>

<div class="content">
    <div class="container">

        <ul>
            <?php
            foreach($libraries as $library) {
                echo "<li><a href='individual-library.php?library_id=" . $library['library_id'] . "'>" . $library['name'] . "</a>";
            }
            ?>
        </ul>
        <a href="library-create.php"><button>Create Library</button></a>
    </div>
</div>

<?php include "../includes/footer.php" ?>

