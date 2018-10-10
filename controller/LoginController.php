<?php

namespace controller;
use Exception;

require_once('model/User.php');
class LoginController {
    
    private $v;
    private $d;
    private $ls;
    private $ss;
    private $cc;
    
    public function __construct (\view\LoginView $v, \view\DashBoard $d, \model\LoginServer $ls, \model\SessionServer $ss, CookieController $cc) {
        $this->v = $v;
        $this->d = $d;
        $this->ls = $ls;
        $this->ss = $ss;
        $this->cc = $cc;
    }
    
    public function isLoginAttempt () {
        return $this->v->postIsLogin();
    }
    
    public function handleLogin () {
        $user = $this->getNewUserInstanceFromLoginRequestData();
        $this->checkAndLoginByPostRequest($user);
        if ($this->v->getRequestStayLoggedIn()) {
            $this->cc->createLoginCookie($user);
        }
    }

    private function checkAndLoginByPostRequest ($user) {
        $this->checkUserData($user);
        $this->loginByPostRequest($user);
    }
    
    private function loginByPostRequest($user) : void {
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