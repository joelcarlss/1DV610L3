<?php
namespace model;
require_once('model/DatabaseConnection.php');

use Exception;

class RegisterServer {

    private $dc;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
    }

    private function isUsernameAvailable($user) {
        
    }
    public function addNewUserToDatabase($user) {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);

        if ($statement->execute()) {
            die ('Success');
        } else {
            die ('Fail');
        }
    }
}