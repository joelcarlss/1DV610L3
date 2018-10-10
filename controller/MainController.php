<?php

namespace controller;
use Exception;
class MainController {
    
    private $v;
    private $dtv;
    private $d;
    private $rv;
    private $st;
    private $ls;
    private $ss;
    private $lc;
    private $cc;
    private $rc;
    
    public function __construct (
    \view\LoginView $v, 
    \view\DateTimeView $dtv, 
    \view\DashBoard $d, 
    \view\RegisterView $rv,

    \model\ServerTime $st, 
    \model\LoginServer $ls, 
    \model\SessionServer $ss,

    \controller\LoginController $lc, 
    \controller\CookieController $cc,
    \controller\RegisterController $rc) {

        $this->v = $v;
        $this->dtv = $dtv;
        $this->rv = $rv;
        $this->st = $st;
        $this->ls = $ls;
        $this->d = $d;
        $this->ss = $ss;
        $this->lc = $lc;
        $this->cc = $cc;
        $this->rc = $rc;
        $this->start();
    }

    private function start () {
        $this->setTime();
        if ($this->ss->isLoggedIn()) {
            //Session
        } else if ($this->lc->isLoginAttempt()) {
            $this->handleLogin();
        } else if ($this->rc->isRegisterAttempt()) {
            $this->rc->handleRegister();
        } else if ($this->cc->isCookieData()) {
            $this->cc->handleCookieLogin();
        }
        // TODO Remove dependency to DashBoard
         if ($this->d->isLogOutAttempt()) {
            $this->ss->logOut();
        }
    }
    private function setTime() {
        $time = $this->st->getCurrentServerTime();
        $this->dtv->setTime($time);
    }
    private function handleLogin () {
        $this->lc->handleLogin();
    }
}