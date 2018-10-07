<?php

namespace controller;
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
            
        }
    }
    public function registerNewUser() {
        $this->rs->registerNewUser($user); // needs to be instance of user
    }

}