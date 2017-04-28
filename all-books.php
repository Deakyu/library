<?php include "session-start.php" ?>
<?php include "login-middleware.php" ?>
<?php include "includes/header.php"; ?>
<?php include "db.php"; ?>
<?php
$db = new DB();
//$books = $db->getAllBooksByUserId(2);
$books = $db->getAllBooksByLibraryId(1);
?>

<ul>
    <?php
        foreach($books as $book) {
            echo "<li>" . $book['title'] . "</li>";
        }

        if(isset($_SESSION['login-status']) && isset($_SESSION['user_id'])) {
            echo $_SESSION['login-status'] . "<br>";
            echo $_SESSION['user_id'];
        }
    ?>

</ul>

<?php include "includes/footer.php" ?>
