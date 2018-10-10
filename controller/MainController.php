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
    \controller\RegisterController $rc) {

        $this->v = $v;
        $this->dtv = $dtv;
        $this->rv = $rv;
        $this->st = $st;
        $this->ls = $ls;
        $this->d = $d;
        $this->ss = $ss;
        $this->lc = $lc;
        $this->rc = $rc;
        $this->start();
    }

    private function start () {
        $this->setTime();
        if ($this->ss->isLoggedIn()) {
            //Session
        } else if ($this->v->postIsLogin()) {
            $this->lc->handleLogin();
        } else if ($this->rv->isRegisterPost()) {
            $this->rc->handleRegister();
        } else if ($this->v->isCookieData()) {
            // Do Cookie
        }
         if ($this->d->isLogOutAttempt()) {
            $this->ss->logOut();
        }
    }
    private function setTime() {
        $time = $this->st->getCurrentServerTime();
        $this->dtv->setTime($time);
    }
}