<?php

namespace controller;

require_once('view/Messages.php');
require_once('model/User.php');

use Exception;
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

            $this->d->setMessage(\view\Messages::LOGIN_BY_POST);

            if ($this->v->getRequestStayLoggedIn()) {
                $this->cc->createLoginCookie($user);
            }
        } catch (\model\ValidationException $e) {
            $this->v->setMessage(\view\Messages::AUTH_ERROR_LOGIN);
        } catch (Exception $e) {
            $this->v->setMessage($e->getMessage());
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