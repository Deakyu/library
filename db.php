<?php

class DB
{
    public $conn;

    function __construct() {
        $server = '127.0.0.1';
        $user = 'root';
        $pw = '';
        $this->conn = new mysqli(
            $server, $user, $pw, 'library'
        );
        if ($this->conn->connect_error) {
            die('connection failed: ' . $this->conn->connect_error);
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }

    ///////////////////////////////////////////
    //         User functions    //////////////
    ///////////////////////////////////////////
    // TESTED
    public function createUser($username, $pw) {
        $sql = $this->conn->prepare("
            INSERT INTO users (username, pw) VALUES (?, ?)
        ");
        $hash = password_hash($pw, PASSWORD_BCRYPT, ['cost'=>11]);
        $sql->bind_param("ss", $username, $hash);
        $sql->execute();
    }

    // TESTED
    public function authenticate($username, $pw) {
        $sql = $this->conn->prepare("
            SELECT username, pw FROM users WHERE username = ?
        ");
        $sql->bind_param("s", $username);
        $sql->execute();
        $sql->bind_result($un, $hash);
        $sql->fetch();
        if($un && $hash) {
            if(password_verify($pw, $hash)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function getUserId($username) {
        $sql = $this->conn->prepare("
            SELECT user_id FROM users WHERE username = ?
        ");
        $sql->bind_param("s", $username);
        $sql->execute();
        $sql->bind_result($userId);
        $sql->fetch();
        return $userId;
    }

    public function getUsernameById($id) {
        $sql = $this->conn->prepare("
            SELECT username FROM users WHERE user_id = ?
        ");
        $sql->bind_param("i", $id);
        $sql->execute();
        $sql->bind_result($username);
        $sql->fetch();
        return $username;
    }

    // TESTED
    public function deleteUserById($userId) {
        $sql = $this->conn->prepare("
            DELETE FROM users WHERE user_id = ?
        ");
        $sql->bind_param("i", $userId);
        $sql->execute();
        $db = new DB();
        $bookIds = $db->getAllBooksByUserId($userId);
        foreach($bookIds as $bookId) {
            $db->updateRentStatusByBookId($bookId['book_id']);
        }

    }



    ///////////////////////////////////////////
    //        Libraries function //////////////
    ///////////////////////////////////////////
    // TESTED
    public function createLibrary($name, $street, $city, $state, $zip) {
        $sql = $this->conn->prepare("
            INSERT INTO libraries(`name`, add_street, add_city, add_state, add_zip) VALUES (?, ?, ?, ?, ?)
        ");
        $sql->bind_param("sssss", $name, $street, $city, $state, $zip);
        $sql->execute();
    }

    // TESTED
    public function getAllLibraries() {
        $sql = $this->conn->query("
            SELECT * FROM libraries
        ");
        $libraries = [];
        while($row = $sql->fetch_assoc()) {
            $libraries[] = $row;
        }
        return $libraries;
    }

    // TESTED
    public function getAllBooksByLibraryId($id) {
        $sql = $this->conn->prepare("
            SELECT * FROM books WHERE library_id = ?
        ");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        $books = [];
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    ///////////////////////////////////////////
    //       Books functions //////////////////
    ///////////////////////////////////////////
    // TESTED
    public function createBook($title, $date, $libraryId, $authorId, $userId) {
        $sql = $this->conn->prepare("
            INSERT INTO books (title, date_of_publish, library_id, author_id, user_id) VALUES (?, ?, ?, ?, ?)
        ");
        $sql->bind_param("ssiii", $title, $date, $libraryId, $authorId, $userId);
        $sql->execute();
    }

    // TESTED
    public function updateRentStatusByBookId($bookId) {
        $available = 999999999;
        $sql = $this->conn->prepare("
            UPDATE books SET user_id=? WHERE book_id = ?
        ");
        $sql->bind_param("ii", $available, $bookId);
        $sql->execute();
    }

    public function whoRentIt($bookId) {
        $sql = $this->conn->prepare("
            SELECT user_id FROM books WHERE book_id = ?
        ");
        $sql->bind_param("i", $bookId);
        $sql->execute();
        $sql->bind_result($userId);
        $sql->fetch();
        return $userId;
    }

    public function whoWroteIt($bookId) {
        $sql = $this->conn->prepare("
            SELECT author_id FROM books WHERE book_id = ?
        ");
        $sql->bind_param("i", $bookId);
        $sql->execute();
        $sql->bind_result($authorId);
        $sql->fetch();
        return $authorId;
    }

    // TESTED
    public function getAllBooksByUserId($id) {
        $sql = $this->conn->prepare("
            SELECT * FROM books WHERE user_id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        $books = [];
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    // TESTED
    public function getAllBooksByAuthorId($authorId) {
        $sql = $this->conn->prepare("
            SELECT * FROM books WHERE author_id = ?
        ");
        $sql->bind_param("i", $authorId);
        $sql->execute();
        $result = $sql->get_result();
        $books = [];
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    ///////////////////////////////////////////
    //         Authors functions             //
    ///////////////////////////////////////////
    // TESTED
    public function createAuthor($firstName, $lastName) {
        $sql = $this->conn->prepare("
            INSERT INTO authors (first_name, last_name) VALUES (?, ?)
        ");
        $sql->bind_param("ss", $firstName, $lastName);
        $sql->execute();
    }

    // TESTED
    public function getAllAuthors() {
        $sql = $this->conn->query("
            SELECT * FROM authors
        ");
        $authors = [];
        while($row = $sql->fetch_assoc()) {
            $authors[] = $row;
        }
        return $authors;
    }

}