<?php

namespace controller;
use Exception;

require_once('model/User.php');
class LoginController {
    
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
    public function handleLogin () {
        if ($this->ss->isSession()) {
            $this->loginBySession();
        } else if ($this->v->isCookieData()) {
            $this->loginByCookie();
        } else if ($this->v->postIsLogin()) {
            $this->loginByPostRequest();
        }
    }
    private function loginByCookie() {

    }
    private function loginByPostRequest() : void {
        $username = $this->v->getRequestUserName();
        $password = $this->v->getRequestPassword();
        $this->getNewUserInstance($username, $password);
    }
    private function loginBySession() {
        
    }
    private function getNewUserIstance($username, $password) : \model\User {
        return new \model\User($username, $password);
    }
}