<?php include "session-start.php" ?>
<?php include "login-middleware.php" ?>
<?php include "includes/header.php" ?>
<?php include "db.php";

    $db = new DB();
    if(isset($_GET['id'])) {
        $library = $db->getLibraryById($_GET['id']);
    } else {
        $library = false;
    }

    $booksInTheLibrary = $db->getAllBooksByLibraryId($library['library_id']);
?>

<div class="container">
    <ul class="lib-list">
        <?php
            foreach($booksInTheLibrary as $book) {
                $author = $db->getAuthorById($book['author_id']);
                echo "<li>" . $book['title'] . "</li>";
                echo "<li>" . $book['date_of_publish'] . "</li>";
                echo "<li>" . $author['first_name'] . " " . $author['last_name'] . "</li>";
                if($book['user_id'] == available) {
                    echo "<li><a href='rent.php?book_id=" . $book['book_id'] . "'><button>Rent</button></a></li>";
                } else {
                    echo "<li><a href='return-book.php?book_id=" . $book['book_id'] . "'><button>Return</button></a></li>";
                }
                echo "<hr><br>";
            }
        ?>
    </ul>
</div>


<?php include "includes/footer.php" ?>
