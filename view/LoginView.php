<?php

namespace view;

class LoginView {
	private $login = 'LoginView::Login';
	private $name = 'LoginView::UserName';
	private $password = 'LoginView::Password';
	private $cookieName = 'LoginView::CookieName';
	private $cookiePassword = 'LoginView::CookiePassword';
	private $keep = 'LoginView::KeepMeLoggedIn';
	private $messageId = 'LoginView::Message';

	private $missingUsernameMessage = 'Username is missing';
	private $missingPasswordMessage = 'Password is missing';
	private $authErrorMessage = 'Wrong name or password';
	private $logoutMessage = 'Bye bye!';
	private $authErrorCookieMessage = 'Wrong information in cookies';
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';
		
		$response = $this->generateLoginFormHTML($message);
		//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . $this->messageId . '">' . $message .'</p>
				<input type="submit" name="' . $this->logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . $this->messageId . '">' . $message . '</p>
					
					<label for="' . $this->name . '">Username :</label>
					<input type="text" id="' . $this->name . '" name="' . $this->name . '" value="" />

					<label for="' . $this->password . '">Password :</label>
					<input type="password" id="' . $this->password . '" name="' . $this->password . '" />

					<label for="' . $this->keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . $this->keep . '" name="' . $this->keep . '" />
					
					<input type="submit" name="' . $this->login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	// POST REQUEST FUNCTIONALITY

	/**
	 * Checks if post type is login.
	 * @return bool
	 */
	public function postIsLogin() {
		if (!empty($_POST)) {
			if (isset($_POST[$type])) { 
				return true; 
			}
		}
		return false;
	}

	// GETS

	public function getRequestStayLoggedIn () {
		return isset($_POST[$this->keep]);
	}
	public function getRequestUserName() {
		return $_POST[$this->name];
	}

	public function getRequestPassword() {
		return $_POST[$this->password];
	}
	

	// COOKIE FUNCTIONALITY


	public function isCookieUserData () {
		return (isset($_COOKIE[$this->cookieName]) && isset($_COOKIE[$this->cookiePassword]));
	}

	/**
	 * Creates cookie to store userdata.
	 */
	public function createCookieByUserData ($user) {
		setcookie($this->cookieName, $user->getUsername(), time() + (86400 * 30), "/");
		setcookie($this->cookiePassword, $user->getHashedPassword(), time() + (86400 * 30), "/");
	}
	/**
	 * Clears data in cookie and changes time to expired
	 */
	public function clearUserDataCookie () {
			setcookie($this->cookieName, '', time()-3600);
			setcookie($this->cookiePassword, '', time()-3600);
	}
}