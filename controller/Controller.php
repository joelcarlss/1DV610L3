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
    private $ss;
    
    public function __construct (\view\LoginView $v, \view\DateTimeView $dtv, \view\DashBoard $d, \model\ServerTime $st, \model\LoginServer $ls, \model\SessionServer $ss,  \controller\LoginController $lc) {
        $this->v = $v;
        $this->dtv = $dtv;
        $this->st = $st;
        $this->ls = $ls;
        $this->d = $d;
        $this->lc = $lc;
        $this->ss = $ss;
        $this->start();
    }

    private function start () {
        $this->setTime();
        if (!$this->ss->isLoggedIn()) {
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