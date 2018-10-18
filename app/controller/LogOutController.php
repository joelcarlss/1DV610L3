<?php

namespace controller;

require_once('app/view/Messages.php');

/**
 * Class holding functionality related to log out by post
 */

use Exception;
class LogOutController {
    
    private $v;
    private $d;
    private $ss;
    
    public function __construct (\view\LoginView $v, \view\DashBoard $d, \model\SessionServer $ss) {
        $this->v = $v;
        $this->d = $d;
        $this->ss = $ss;
    }

    public function isLoggedIn () : bool {
        return $this->ss->isLoggedIn();
    }

    public function isLogOutAttempt () : bool {
        return $this->d->isLogOutAttempt();
    }

    public function handleLogOutAttempt () {
        $this->ss->logOut();
        $this->v->setMessage(\view\Messages::LOGOUT_MESSAGE);
        $this->v->clearCookieUserData();
    }
    
}