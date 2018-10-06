<?php

namespace model;
use Exception;
class User {
    
    private $username;
    private $password;

    public function __construct (string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Hashes string
     * @return string
     */
    public function getHashedPassword () {
        return password_hash($this->password, PASSWORD_DEFAULT);

    }

    /**
     * Get private value of $username
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Get private value of $password
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

}