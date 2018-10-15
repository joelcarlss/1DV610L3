<?php

namespace controller;
require_once('model/User.php');
use Exception;

/**
 * Holding server functionality for registering by post request
 */
class RegisterController {
    
    private $rv;
    private $rs;
    
    public function __construct (\view\RegisterView $rv, \model\RegisterServer $rs) {
        $this->rv = $rv;
        $this->rs = $rs;
    }
    public function isRegisterAttempt () : bool {
        return $this->rv->isRegisterPost();
    }
    public function handleRegister() : void {
        try {
            $user = $this->getNewUserWithRequestData();
            $this->registerNewUser($user);
            
            
        } catch(Exception $e) {
            $this->rv->setMessage($e->getMessage());
        }
    }

    private function getNewUserWithRequestData() : \model\User {
            $username = $this->rv->getUserName();
            $password = $this->rv->getPassword();
            if ($password && $username) {
                return new \model\User($username, $password);
            }
    }

    public function registerNewUser($user) : void {
        $this->rs->registerNewUser($user); // needs to be instance of user
    }
}