<?php

namespace model;
use Exception;

class LoginServer {


    public function isLoggedIn () {
        return false;
    }
    
    public function loginByUserCredentials ($user) {
        $username = $user->getUsername();
        $password = $user->getUsername();
        return true;
    }

    public function loginByCookieCredentials ($user) {
            
    }
    private function validateAndLoginUser ($user) {
        
    }
    
    public function logOut () {
    }
    
    private function isCorrectUsername($username) {
    }

    private function isCorrectPassword($password) {
    }

    public function hashPasswordString ($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    private function stringNotEmpty ($string) {
        return (strlen($string) > 0);
    }
}