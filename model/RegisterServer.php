<?php
namespace model;

require '/model/DatabaseConnection.php';
use Exception;

class LoginServer {

    private $dc;
    public function __constructor (\model\DatabaseConnection $dc) {
        $this->dc = $dc;
    }
    public function registerNewUser($user) {
        $this->addNewUserToDatabase($user);
    }
    private function addNewUserToDatabase($user) {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $conn->prepare($sql);
    }
}