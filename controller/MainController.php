<?php

namespace controller;
use Exception;

class MainController {
    
    private $v;
    private $dtv;

    private $st;

    private $lc;
    private $loc;
    private $cc;
    private $rc;
    
    public function __construct (
    \view\LoginView $v, 
    \view\DateTimeView $dtv,

    \model\ServerTime $st,

    \controller\LoginController $lc,
    \controller\LogOutController $loc,
    \controller\CookieController $cc,
    \controller\RegisterController $rc) {

        $this->v = $v;
        $this->dtv = $dtv;
        $this->st = $st;
        $this->lc = $lc;
        $this->loc = $loc;
        $this->cc = $cc;
        $this->rc = $rc;
        
    }

    /**
     * Sets server time then checks if any user input or cookies needs to be handled
     */
    public function start () : void {
        $this->sendTimeToView();
        if ($this->loc->isLoggedIn()) {
             if ($this->loc->isLogOutAttempt()) {
                $this->loc->handleLogOutAttempt();
            }
        } else if ($this->lc->isLoginAttempt()) {
            $this->lc->handleLogin();
        } else if ($this->rc->isRegisterAttempt()) {
            $this->rc->handleRegister();
        } else if ($this->cc->isCookieData()) {
            $this->cc->handleCookieLogin();
        }
    }

    /**
     * Gets time from ServerTime and sends it to DateTimeView
     */
    private function sendTimeToView() : void {
        $time = $this->st->getCurrentServerTime();
        $this->dtv->setTime($time);
    }
}