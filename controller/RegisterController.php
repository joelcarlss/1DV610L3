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
    public function isRegisterAttempt () : bool {
        return $this->rv->isRegisterPost();
    }
    public function handleRegister() : void {
        try {
            $user = $this->getNewUserWithRequestData();
            $this->registerNewUser($user);
            //// DU ÄR HÄR. RENDER LOGINPAGE
            // header("Location: /"); /* Redirect browser */
            // exit();
            
            
        } catch(Exception $e) {
            $this->rv->setMessage($e->getMessage());
        }
    }

    private function getNewUserWithRequestData() : \model\User {
            $username = $this->rv->getUserName();
            $password = $this->rv->getPassword();
            if ($username && $password) {
                return new \model\User($username, $password);
            }
    }

    public function registerNewUser($user) : void {
        $this->rs->registerNewUser($user); // needs to be instance of user
    }
}