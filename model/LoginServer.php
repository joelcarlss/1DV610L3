<?php

namespace model;
use customException;

class LoginServer {


    private $dc;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
    }
    
    public function loginByUserCredentials ($user) : bool {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        $password = $user->getPassword();

        $records = $connect->prepare('SELECT id,username,password FROM users WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $result = $records->fetch(\PDO::FETCH_ASSOC);

        // TODO FIX PROBLEM WITH VALIDATION OF HASHED COOKIE STRING
        if ($result && password_verify($password, $result['password'])) {
            $user->setId($result['id']);
            return true;
        } else {
            throw new Exception ('Validation Error');
        }
    }

}