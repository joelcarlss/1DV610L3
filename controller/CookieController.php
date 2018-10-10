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
    public function isCookieData() {
        return $this->v->isCookieUserData();
    }
    public function createLoginCookie($postRequestUser) {
        $this->v->createCookieByUserData($postRequestUser);
    }
    public function handleCookieLogin () {
        $user = $this->getNewUserInstanceFromCookieData();
        $this->loginByCookieData($user);
    }

    private function loginByCookieData($user) : void {
        if ($this->ls->loginByUserCredentials($user)) {
            $this->ss->createSessionByUserData($user);
        }
    }

    private function getNewUserInstanceFromCookieData() : \model\User {
        $username = $this->v->getCookieUsername();
        $password = $this->v->getCookiePassword();
        return $this->getNewUserInstance($username, $password);
    }
    private function getNewUserInstance($username, $password) : \model\User {
        return new \model\User($username, $password);
    }
}