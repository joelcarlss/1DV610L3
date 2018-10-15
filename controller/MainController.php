<?php

namespace controller;
use Exception;

require_once('view/Messages.php');

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
        
    }

    /**
     * Sets server time then checks if any user input or cookies needs to be handled
     */
    private function start () : void {
        $this->sendTimeToView();
        if ($this->ss->isLoggedIn()) {
            // TODO Remove dependency to DashBoard
             if ($this->d->isLogOutAttempt()) {
                $this->ss->logOut();
                $this->v->setMessage(\view\Messages::LOGOUT_MESSAGE);
                $this->v->clearCookieUserData();
            }
            //Session
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