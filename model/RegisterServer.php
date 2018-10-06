<?php
namespace model;

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
        $connect = $this->dc->connect();
        $username = 'testUser';
        $password = 'pswrd';
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