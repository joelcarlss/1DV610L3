<?php

namespace model;
use Exception;

class LoginServer {


    private $dc;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
    }
    
    public function isLoggedIn () {
        return false;
    }
    
    public function loginByUserCredentials ($user) {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        $password = $user->getPassword();

        $records = $connect->prepare('SELECT id,username,password FROM users WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        if (count($results) > 0 && password_verify($password, $results['password'])) {
            return true;
        } else {
            throw new LoginException();
        }
    }

    public function loginByCookieCredentials ($user) {
            
    }
    private function validateAndLoginUser ($user) {
        
    }
    
    public function logOut () {
    }
    
    private function isCorrectUsername($username) {
    }

    private function isCorrectPassword($password) {
    }

    public function hashPasswordString ($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function stringNotEmpty ($string) {
        return (strlen($string) > 0);
    }
}