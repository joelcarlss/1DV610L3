<?php

namespace controller;
use Exception;

require_once('view/Messages.php');
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
    
    public function isLoginAttempt () : bool {
        return $this->v->postIsLogin();
    }
    
    public function handleLogin () : void {
        try {
            $user = $this->getNewUserInstanceFromLoginRequestData();
            $this->loginByPostRequest($user);

            if ($this->v->getRequestStayLoggedIn()) {
                $this->cc->createLoginCookie($user);
            }
        } catch (Exception $e) {
            $this->v->setMessage(\view\Messages::LOGIN_AUTH_ERROR);
        }
    }
    
    private function loginByPostRequest($user) : void {
        if ($this->ls->loginByUserCredentials($user)) {
            $this->ss->createSessionByUserData($user);
        }
    }

    private function getNewUserInstanceFromLoginRequestData() : \model\User {
        $username = $this->v->getUsername();
        $password = $this->v->getPassword();
        return $this->getNewUserInstance($username, $password);
    }
    
    private function getNewUserInstance($username, $password) : \model\User {
        return new \model\User($username, $password);
    }
}