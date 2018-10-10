<?php

namespace controller;
use Exception;

require_once('model/User.php');
class CookieController {
    
    private $v;
    private $d;
    private $ls;
    private $ss;
    
    public function __construct (\view\LoginView $v, \view\DashBoard $d, \model\LoginServer $ls, \model\SessionServer $ss) {
        $this->v = $v;
        $this->d = $d;
        $this->ls = $ls;
        $this->ss = $ss;
    }
    private function loginByCookie() {
        
    }
    // REQUEST
    private function checkAndLogin ($user) {
        $this->checkUserData($user);
        $this->loginByPostRequest($user);
    }
    private function login($user) : void {
        if ($this->ls->loginByUserCredentials($user)) {
            $this->ss->createSessionByUserData($user);
        }
    }

    private function checkUserData($user) {
        if (!$this->ls->stringNotEmpty($user->getUsername())) {
            throw new UsernameEmpty();
        } else if (!$this->ls->stringNotEmpty($user->getPassword())) {
            throw new PasswordEmpty();
        }
    }

    private function getNewUserInstanceFromLoginRequestData() : \model\User {
        $username = $this->v->getRequestUserName();
        $password = $this->v->getRequestPassword();
        return $this->getNewUserInstance($username, $password);
    }
    private function getNewUserInstance($username, $password) : \model\User {
        return new \model\User($username, $password);
    }
}