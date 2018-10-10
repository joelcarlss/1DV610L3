<?php

namespace model;
use Exception;

class LoginServer {


    private $dc;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
    }
    
    public function loginByUserCredentials ($user) {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        $password = $user->getPassword();

        $records = $connect->prepare('SELECT id,username,password FROM users WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $results = $records->fetch(\PDO::FETCH_ASSOC);

        if ($results && password_verify($password, $results['password'])) {
            $user->setId($results['id']);
            return true;
        } else {
            throw new LoginValidationError();
        }
    }

    private function validateAndLoginUser ($user) {
        
    }
    
    private function isCorrectUsername($username) {
    }

    private function isCorrectPassword($password) {
    }
}