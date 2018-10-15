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

    /**
     * @return bool
     */
    public function isRegisterAttempt () : bool {
        return $this->rv->isRegisterPost();
    }

    /**
     * Handles register by post request.
     * Gets user and sends it to registry
     * Sends message to view if error occurs
     */
    public function handleRegister() : void {
        try {
            $user = $this->getNewUserWithRequestData();
            $this->rs->registerNewUser($user);
            
            
        } catch(Exception $e) {
            $this->rv->setMessage($e->getMessage());
        }
    }

    /**
     * @return new User instance if username and password from post exists.
     */
    private function getNewUserWithRequestData() : \model\User {
        $username = $this->rv->getUserName();
        $password = $this->rv->getPassword();
        if ($password && $username) {
            return new \model\User($username, $password);
        }
    }
}