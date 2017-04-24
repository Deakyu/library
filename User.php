<?php

class User extends DB
{
    protected $username;
    protected $pw;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->pw = $password;
    }

    public function verifyUser($username, $password) {
        if($this->username == $username && $this->pw == $password) {
            return true;
        } else {
            return false;
        }
    }
}