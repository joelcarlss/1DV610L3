<?php

namespace model;
use Exception;
class User {
    
    private $username;
    private $password;
    private $id;

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
    /**
     * Sets id.
     */
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * Compares string to user password. 
     * If same, returns true
     * @return bool
     */
    public function isStringSameAsPassword ($string) {
        return $this->password == $string;
    }

}