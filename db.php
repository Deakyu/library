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

    public function createUserWithAdmin($username, $pw, $isAdmin) {
        $sql = $this->conn->prepare("
            INSERT INTO users (username, pw, is_admin) VALUES (?, ?, ?)
        ");
        $hash = password_hash($pw, PASSWORD_BCRYPT, ['cost'=>11]);
        $sql->bind_param("ssi", $username, $hash, $isAdmin);
        $sql->execute();
    }

    public function checkUsername($username) {
        $user = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

        $sql = $this->conn->prepare("
            SELECT username FROM users WHERE username = ?
        ");
        $sql->bind_param("s", $user);
        $sql->execute();
        $sql->bind_result($user);
        if($sql->fetch()) {
            return "not available";
        } else {
            return "available";
        }

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

    public function getAllUsers() {
        $sql = $this->conn->query("
            SELECT * FROM users
        ");
        $users = [];
        while($row = $sql->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;

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

    public function getUserById($id) {
        $sql = $this->conn->prepare("
            SELECT * FROM users WHERE user_id = ?
        ");
        $sql->bind_param("i", $id);
        $sql->execute();
        $sql->bind_result($userId, $username, $pw, $isAdmin);
        $sql->fetch();
        if($userId) {
            $user = [];
            $user['user_id'] = $userId;
            $user['username'] = $username;
            $user['pw'] = $pw;
            $user['is_admin'] = $isAdmin;
            return $user;
        }
        return false;
    }

    // TESTED
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

    public function updateUser($userId, $username, $pw, $isAdmin) {
        $sql = $this->conn->prepare("
            UPDATE users SET username=?, pw=?, is_admin=? WHERE user_id = ?
        ");
        $hash = password_hash($pw, PASSWORD_BCRYPT, ['cost'=>11]);
        $sql->bind_param("ssii", $username, $hash, $isAdmin, $userId);
        $sql->execute();
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

    public function updateLibrary($libraryId, $name, $street, $city, $state, $zip) {
        $sql = $this->conn->prepare("
            UPDATE libraries SET `name`=?, add_street=?, add_city=?, add_state=?, add_zip=? WHERE library_id=?
        ");
        $sql->bind_param("sssssi", $name, $street, $city, $state, $zip, $libraryId);
        $sql->execute();
    }

    public function deleteLibraryById($id) {
        $sql = $this->conn->prepare("
            DELETE FROM libraries WHERE library_id = ?
        ");
        $sql->bind_param("i", $id);
        $sql->execute();
        $db = new DB();
        $db->deleteBookByLibraryId($id);
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

    public function getLibraryById($id) {
        $sql = $this->conn->prepare("
            SELECT * FROM libraries WHERE library_id = ?
        ");
        $sql->bind_param("i", $id);
        $sql->execute();
        $sql->bind_result($libraryId, $name, $addStreet, $addCity, $addState, $addZip);
        $sql->fetch();
        if($libraryId) {
            $library = [];
            $library['library_id'] = $libraryId;
            $library['name'] = $name;
            $library['add_street'] = $addStreet;
            $library['add_city'] = $addCity;
            $library['add_state'] = $addState;
            $library['add_zip'] = $addZip;
            return $library;
        }
        return false;
    }

    public function getLibraryByName($name) {
        $sql = $this->conn->prepare("
            SELECT * FROM libraries WHERE `name` LIKE ?
        ");
        $sql->bind_param("s", $name);
        $sql->execute();
        $result = $sql->get_result();
        $libraries = [];
        while($row = $result->fetch_assoc()) {
            $libraries[] = $row;
        }
        return $libraries;
    }

    ///////////////////////////////////////////
    //       Books functions //////////////////
    ///////////////////////////////////////////
    // TESTED
    public function createBook($title, $date, $libraryId, $author, $userId) {
        $sql = $this->conn->prepare("
            INSERT INTO books (title, date_of_publish, library_id, author, user_id) VALUES (?, ?, ?, ?, ?)
        ");
        $sql->bind_param("ssisi", $title, $date, $libraryId, $author, $userId);
        $sql->execute();
    }

    public function updateBook($bookId, $title, $dateOfPublish, $author, $libraryId, $userId) {
        $sql = $this->conn->prepare("
            UPDATE books SET title=?, date_of_publish=?, author=?, library_id=?, user_id=? WHERE book_id=?
        ");
        $sql->bind_param("sssiii", $title, $dateOfPublish, $author, $libraryId, $userId, $bookId);
        $sql->execute();
    }

    public function deleteBookById($bookId) {
        $sql = $this->conn->prepare("
            DELETE FROM books WHERE book_id = ?
        ");
        $sql->bind_param("i", $bookId);
        $sql->execute();
    }

    public function deleteBookByLibraryId($libraryId) {
        $sql = $this->conn->prepare("
            DELETE FROM books WHERE library_id = ?
        ");
        $sql->bind_param("i", $libraryId);
        $sql->execute();
    }

    public function getAllBooks() {
        $sql = $this->conn->query("
            SELECT * FROM books
        ");
        $books = [];
        while($row = $sql->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    public function getBookById($id) {
        $sql = $this->conn->prepare("
            SELECT * FROM books WHERE book_id = ?
        ");
        $sql->bind_param("i", $id);
        $sql->execute();
        $sql->bind_result($bookId, $title, $dateOfPublish, $libraryId, $userId, $author);
        $sql->fetch();
        if($bookId) {
            $book = [];
            $book['book_id'] = $bookId;
            $book['title'] = $title;
            $book['date_of_publish'] = $dateOfPublish;
            $book['library_id'] = $libraryId;
            $book['author'] = $author;
            $book['user_id'] = $userId;
            return $book;
        }
        return false;
    }

    public function getBookByTitle($title) {
        $sql = $this->conn->prepare("
            SELECT * FROM books WHERE title LIKE ?
        ");
        $sql->bind_param("s", $title);
        $sql->execute();
        $result = $sql->get_result();
        $books = [];
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    public function rentBook($bookId, $userId) {
        $sql = $this->conn->prepare("
            UPDATE books SET user_id=? WHERE book_id = ?
        ");
        $sql->bind_param("ii", $userId, $bookId);
        $sql->execute();
    }

    // TESTED
    public function updateRentStatusByBookId($bookId) {
        $available = -1;
        $sql = $this->conn->prepare("
            UPDATE books SET user_id=? WHERE book_id = ?
        ");
        $sql->bind_param("ii", $available, $bookId);
        $sql->execute();
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

    public function getAllBooksByLibraryId($libraryId) {
        $sql= $this->conn->prepare("
            SELECT * FROM books WHERE library_id = ?
        ");
        $sql->bind_param("i", $libraryId);
        $sql->execute();
        $result = $sql->get_result();
        $books = [];
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }























}