<?php
namespace model;
require_once('model/DatabaseConnection.php');

use Exception;

class RegisterServer {

    private $dc;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
    }

    public function registerNewUser($user) {
        if ($this->isUsernameAvailable($user)) {

        }
    }
    private function isUsernameAvailable($user) {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        
        $records = $connect->prepare('SELECT id,username,password FROM users WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        return (!count($results) > 0);
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