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
        $this->addNewUserToDatabase($user);
    }
    private function addNewUserToDatabase($user) {
        $db = new \model\DatabaseConnection();
        $connect = $db->connect();
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