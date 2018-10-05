<?php

namespace model;
use Exception;
class UserCredentials {
    
    private $username;
    private $password;
    private $userId = '123';
    

    public function __construct (string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Hashes string
     * @return string
     */
    public function setAndHashPassword ($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

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
     * Get private value of $userId
     * @return string
     */
    public function getUserId() {
        return $this->userId;
    }

}