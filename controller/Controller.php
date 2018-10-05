<?php

namespace controller;
use Exception;
class Controller {
    
    private $v;
    private $dtv;
    private $st;
    private $ls;
    private $d;
    private $lc;
    
    public function __construct (\view\LoginView $v, \view\DateTimeView $dtv, \view\DashBoard $d, \model\ServerTime $st, \model\LoginServer $ls,  \controller\LoginController $lc) {
        $this->v = $v;
        $this->dtv = $dtv;
        $this->st = $st;
        $this->ls = $ls;
        $this->d = $d;
        $this->lc = $lc;
        $this->start();
    }

    private function start () {
        $this->setTime();
        if (!$this->ls->isLoggedIn()) {
            $this->lc->handleLogin();
        } else if ($this->v->isLogOutAttempt()) {
            $this->ls-logOut();
        }
    }
    private function setTime() {
        $time = $this->st->getCurrentServerTime();
        $this->dtv->setTime($time);
    }
}