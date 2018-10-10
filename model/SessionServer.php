<?php

namespace model;
use Exception;

class SessionServer {

    
    public function loginBySessionData ($user) {
    }

    public function isLoggedIn () {
        return $this->isSession();
    }
    
    public function logOut () {
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
    private function isSession () {
        return !empty($_SESSION);
    }

    /**
     * Gives $_SESSION necessary data from user instance
     */
    public function createSessionByUserData($user) {
        $_SESSION['userId'] = $user->getId();
        $_SESSION['userName'] = $user->getUsername();
    }
    /**
     * Deletes and destroys the session
     */
    private function destroySession () {
        unset($_SESSION);
        session_destroy();
    }
}