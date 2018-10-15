<?php

namespace model;
use Exception;
/**
 * Class holding functionality for everything related to Session.
 */
class SessionServer {

    /**
     * @return bool depending on if session is set or not
     */
    public function isLoggedIn () : bool {
        return $this->isSession();
    }
    
    /**
     * Logs out user by destroying the session
     */
    public function logOut () : void {
            $this->destroySession();
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