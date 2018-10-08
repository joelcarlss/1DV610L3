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

    public function handleRegister() {
        if ($this->rv->isRegisterPost()) {
            $user = $this->getNewUserWithRequestData();
            // Check if user password is the same
        }
    }
    private function getNewUserWithRequestData() {
        $username = $this->rv->getRequestUsername();
        $password = $this->rv->getRequestPassword();
        
        return new \model\User($username, $password);
    }
    public function registerNewUser() {
        $this->rs->registerNewUser($user); // needs to be instance of user
    }

}