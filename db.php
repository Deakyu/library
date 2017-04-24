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
    public function createUser($username, $pw) {
        $sql = $this->conn->prepare("
            INSERT INTO users (username, pw) VALUES (?, ?)
        ");
        $hash = password_hash($pw, PASSWORD_BCRYPT, ['cost'=>11]);
        $sql->bind_param("ss", $username, $hash);
        $sql->execute();
    }

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

    public function findUserId($username) {
        $sql = $this->conn->prepare("
            SELECT user_id FROM users WHERE username = ?
        ");
        $sql->bind_param("s", $username);
        $sql->execute();
        $sql->bind_result($userId);
        $sql->fetch();
        return $userId;
    }

    public function findAllBooksByUserId($id) {
        $sql = $this->conn->query("
            SELECT * FROM books WHERE user_id = " . $id);
        $books = [];
        while($row = $sql->fetch_assoc()) {
            $books[] = $row;
        }
        return $books;
    }

    ///////////////////////////////////////////
    //        Libraries function //////////////
    ///////////////////////////////////////////
    public function createLibrary($name, $street, $city, $state, $zip) {
        $sql = $this->conn->prepare("
            INSERT INTO libraries(`name`, add_street, add_city, add_state, add_zip) VALUES (?, ?, ?, ?, ?)
        ");
        $sql->bind_param("sssss", $name, $street, $city, $state, $zip);
        $sql->execute();
    }

    ///////////////////////////////////////////
    //       Books functions //////////////////
    ///////////////////////////////////////////
    public function createBook($title, $date, $libraryId, $authorId, $userId) {
        $sql = $this->conn->prepare("
            INSERT INTO books (title, date_of_publish, library_id, author_id, user_id) VALUES (?, ?, ?, ?, ?)
        ");
        $sql->bind_param("ssiii", $title, $date, $libraryId, $authorId, $userId);
        $sql->execute();
    }

    ///////////////////////////////////////////
    //         Authors functions             //
    ///////////////////////////////////////////


}