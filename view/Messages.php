<?php
namespace view;
class Messages {
    const AUTH_ERROR_LOGIN = 'Wrong name or password';
    const AUTH_ERROR_COOKIE = 'Wrong information in cookies';

    const LOGIN_BY_POST = 'Welcome';
	const LOGIN_REMEMBER = 'Welcome and you will be remembered';
    const LOGIN_BY_COOKIE = 'Welcome back with cookie';
    
	const LOGOUT_MESSAGE = 'Bye bye!';
    
	const USERNAME_MISSING = 'Username is missing';
    const USERNAME_TO_SHORT = 'Username has too few characters, at least 3 characters.';
    const USERNAME_UNAVAILABLE = 'Username not available.';
    
	const PASSWORD_MISSING = 'Password is missing';
	const PASSWORD_TO_SHORT = 'Password has too few characters, at least 6 characters.';
    CONST PASSWORD_MISMATCH = 'Passwords do not match.';
    
}