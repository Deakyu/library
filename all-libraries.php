<?php include "session-start.php" ?>
<?php include "login-middleware.php" ?>
<!-- shows the list of libraries -->
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
        <th>Link</th>
        </thead>
        <tbody>
        <?php

        foreach($libraries as $library) {
            echo "<tr>
                    <td>" . $library['name'] . "</td>
                    <td>" . $library['add_street'] . ", " . $library['add_city'] . ", " . $library['add_state'] . "</td>";
            echo "<td><a href='/individual-library.php?id=" . $library['library_id'] . "'><button>GO</button></a></td>";
            echo "</tr>";
        }

        ?>
        </tbody>
    </table>
</div>

<?php include "includes/footer.php"; ?>
