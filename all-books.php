<?php include "includes/header.php"; ?>
<?php include "db.php"; ?>
<?php
$db = new DB();
$books = $db->findAllBooksByUserId(1);
?>

<ul>
    <?php

    foreach($books as $book) {
        echo "<li>" . $book['title'] . "</li><hr>";
    }

    ?>
</ul>

<?php include "includes/footer.php" ?>
