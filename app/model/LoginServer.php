<?php

namespace model;
require_once('app/model/customExceptions.php');

/**
 * Holding server functionality for login by post request
 */
class LoginServer {


    private $dc;
    public function __construct (\model\DatabaseConnection $dc) {
        $this->dc = $dc; 
    }
    
    /**
     * Checks if user credentials match by making a search to database.
     * If username exsists and password matches bool true is returned
     */
    public function userCredentialsMatch ($user) : bool {
        $connect = $this->dc->connect();
        $username = $user->getUsername();
        $password = $user->getPassword();

        $records = $connect->prepare('SELECT id,username,password FROM users WHERE username = :username');
        $records->bindParam(':username', $username);
        $records->execute();
        $result = $records->fetch(\PDO::FETCH_ASSOC);

        // TODO FIX PROBLEM WITH VALIDATION OF HASHED COOKIE STRING
        if ($result['username'] == $username && password_verify($password, $result['password'])) {
            $user->setId($result['id']);
            return true;
        } else {
            throw new ValidationException ('Validation Error');
        }
    }

}