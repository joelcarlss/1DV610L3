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
    public function getHashedPassword () : string {
        return password_hash($this->password, PASSWORD_DEFAULT);

    }

    /**
     * Get private value of $username
     * @return string
     */
    public function getUsername() : string {
        return $this->username;
    }

    /**
     * Get private value of $password
     * @return string
     */
    public function getPassword() : string {
        return $this->password;
    }
    public function getId() {
        return $this->id;
    }
    /**
     * Sets id.
     */
    public function setId($id) : void {
        $this->id = $id;
    }

}