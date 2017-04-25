<?php include "session-start.php" ?>
<!-- index.php -->
<!-- shows the list of libraries -->

<?php
    // constant number for user_id in book
    // -> indicates that the book is available(not rented yet)
    const availbable = 999999999;

?>

<?php include "includes/header.php"; ?>
<?php include "db.php"; ?>
<div class="container">
        <?php
        $db = new DB();
        $libraries = $db->getAllLibraries();
        ?>
    <table class="lib-list">
        <thead>
            <th>Library</th>
            <th>Address</th>
            <th>asd</th>
        </thead>
        <tbody>
            <?php

            foreach($libraries as $library) {
                echo "<tr>
                    <td>" . $library['name'] . "</td>
                    <td>" . $library['add_street'] . ", " . $library['add_city'] . ", " . $library['add_state'] . "</td>
                    <td></td>
                  </tr>";
            }

            ?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
