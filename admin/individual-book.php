<?php include "../session-start.php" ?>
<?php include "admin-middleware.php" ?>
<?php include "../includes/header.php" ?>
<?php include "admin-sidebar.php" ?>
<?php include "../db.php" ?>
<?php
$db = new DB();
if(isset($_GET['book_id'])) {
    $book = $db->getBookById($_GET['book_id']);
    $libraryOfTheBook = $db->getLibraryById($book['library_id']);
    $userOfTheBook = $db->getUserById($book['user_id']);
} else {
    $book = false;
    $libraryOfTheBook = false;
    $userOfTheBook = false;
}
?>

<div class="content">

    <div class="container">
        <table>
            <tr>
                <td>ID</td>
                <td><?php echo $book ? $book['book_id'] : "No Book found" ?></td>
            </tr>
            <tr>
                <td>Title</td>
                <td><?php echo $book ? $book['title'] : "No Book found" ?></td>
            </tr>
            <tr>
                <td>Date Of Publish</td>
                <td><?php echo $book ? $book['date_of_publish'] : "No Book found" ?></td>
            </tr>
            <tr>
                <td>Author</td>
                <td><?php echo $book ? $book['author'] : "No Book found" ?></td>
            </tr>
            <tr>
                <td>Library Owning the Book</td>
                <td><?php echo $libraryOfTheBook ? $libraryOfTheBook['name'] : 'No Library found' ?></td>
            </tr>
            <tr>
                <td>User Who Rent The Book</td>
                <td><?php echo $userOfTheBook ? $userOfTheBook['username'] : 'No User Found' ?></td>
            </tr>
            <tr>
                <td><a href="/admin/book-edit.php?book_id=<?php echo $book['book_id'] ?>"><button>Edit</button></a></td>
                <td><a href="/admin/book-delete.php?book_id=<?php echo $book['book_id'] ?>"><button>Delete</button></a></td>
            </tr>
        </table>
    </div>
</div>

<?php include "../includes/footer.php" ?>

