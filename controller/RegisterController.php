<?php

namespace controller;
require_once('model/User.php');
use Exception;
class RegisterController {
    
    private $rv;
    private $rs;
    
    public function __construct (\view\RegisterView $rv, \model\RegisterServer $rs) {
        $this->rv = $rv;
        $this->rs = $rs;
    }
    public function isRegisterAttempt () {
        return $this->rv->isRegisterPost();
    }
    public function handleRegister() {
        try {
            $user = $this->getNewUserWithRequestData();
            $this->registerNewUser($user);
            
        } catch(Exception $e) {
            $this->rv->setMessage($e->getMessage());
        }
    }

    private function getNewUserWithRequestData() {
            $username = $this->rv->getUserName();
            $password = $this->rv->getPassword();
            if ($username && $password) {
                return new \model\User($username, $password);
            }
    }

    public function registerNewUser($user) {
        $this->rs->registerNewUser($user); // needs to be instance of user
    }
}