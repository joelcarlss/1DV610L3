<?php

namespace controller;
use Exception;

require_once('view/Messages.php');
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
    public function isCookieData() : bool {
        return $this->v->isCookieUserData();
    }
    public function createLoginCookie($postRequestUser) : void {
        $this->v->createCookieByUserData($postRequestUser);
    }
    public function handleCookieLogin () : void {
        try {
            $user = $this->getNewUserInstanceFromCookieData();
            $this->loginByCookieData($user);

            $this->d->setMessage(\view\Messages::LOGIN_BY_COOKIE);
        } catch (\model\ValidationException $e) {
            $this->v->setMessage(\view\Messages::AUTH_ERROR_LOGIN);
        } catch (Exception $e) {
            $this->v->setMessage(\view\Messages::AUTH_ERROR_COOKIE);
            $this->v->clearCookieUserData();
        }
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