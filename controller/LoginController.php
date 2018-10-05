<?php

namespace controller;
use Exception;
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
        } else if ($this->v->isALoginAttemptByPost()) {
            $this->loginByPostRequest($user);
        }
    }
    private function loginByCookie() {

    }
    private function loginByPostRequest() {

    }
    private function loginBySession() {

    }
}