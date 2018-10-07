<?php

namespace controller;
use Exception;
class Controller {
    
    private $v;
    private $dtv;
    private $st;
    private $ls;
    private $d;
    private $ss;
    private $lc;
    private $rc;
    
    public function __construct (\view\LoginView $v, \view\DateTimeView $dtv, \view\DashBoard $d, \model\ServerTime $st, \model\LoginServer $ls, \model\SessionServer $ss,  \controller\LoginController $lc, \controller\RegisterController $rc) {
        $this->v = $v;
        $this->dtv = $dtv;
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
        $this->lc->handleLogin();
        $this->rc->handleRegister();
        // if ($this->v->isLogOutAttempt()) {
        //     $this->ls-logOut();
        // }
    }
    private function setTime() {
        $time = $this->st->getCurrentServerTime();
        $this->dtv->setTime($time);
    }
}