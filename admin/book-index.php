<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
$books = $db->getAllBooks();
?>

<div class="content">

    <div class="container">

        <ul>
            <?php
            foreach($books as $book) {
                echo "<li><a href='individual-book.php?book_id=" . $book['book_id'] . "'>" . $book['title'] . "</a>";
            }
            ?>
        </ul>
        <a href="book-create.php"><button>Create Book</button></a>
    </div>
</div>

<?php include "../includes/footer.php" ?>

