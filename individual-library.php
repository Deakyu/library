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
                echo "<li>" . $book['title'] . "</li>";
                echo "<li>" . $book['date_of_publish'] . "</li>";
                echo "<li>" . $book['author'] . "</li>";
                if($book['user_id'] == available) {
                    echo "<li><a href='rent.php?book_id=" . $book['book_id'] . "'><button>Rent</button></a></li>";
                } else {
                    if($book['user_id'] == $_SESSION['user']['user_id']) {
                        echo "<li><a href='return-book.php?book_id=" . $book['book_id'] . "'><button>Return</button></a></li>";
                    } else {
                        echo "<li class='rented'>Rented</li>";
                    }
                }
                echo "<hr><br>";
            }
        ?>
    </ul>
</div>

<a href="/all-libraries.php"><button>See All Libraries</button></a>


<?php include "includes/footer.php" ?>
