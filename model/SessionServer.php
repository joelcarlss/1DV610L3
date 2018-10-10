<?php

namespace model;
use Exception;

class SessionServer {

    
    public function loginBySessionData ($user) {
    }

    public function isLoggedIn () : bool {
        return $this->isSession();
    }
    
    public function logOut () : void {
            $this->destroySession();
    }
    
    /**
     * If Session exists it will be returned
     * @return Array
     */
    private function getSessionData() {
        if (!empty($_SESSION)) {
			return $_SESSION;
        }
    }

    /**
     * Checks if Session data exists
     * @return bool
     */
    private function isSession () : bool {
        return !empty($_SESSION);
    }

    /**
     * Gives $_SESSION necessary data from user instance
     */
    public function createSessionByUserData($user) : void {
        $_SESSION['userId'] = $user->getId();
        $_SESSION['userName'] = $user->getUsername();
    }
    /**
     * Deletes and destroys the session
     */
    private function destroySession () : void {
        unset($_SESSION);
        session_destroy();
    }
}