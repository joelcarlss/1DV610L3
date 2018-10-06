<?php

namespace view;

class LoginView {
	private $login = 'LoginView::Login';
	private $logout = 'LoginView::Logout';
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
	
	
	public function getRequestUserName() {
		return $_POST[$this->name];
	}

	public function getRequestPassword() {
		return $_POST[$this->password];
	}
	
	public function postIsLogin() {
		return $this->postIsType($this->login);
	}

	/**
	 * Checks if post type is similar to argument.
	 * @return bool
	 */
	private function postIsType($type) {
		if (!empty($_POST)) {
			if (isset($_POST[$type])) { 
				return true; 
			}
		}
		return false;
	}

	/**
	 * Checks if string contains data. (Length is larger than 0)
	 * @return bool
	 */
	public function stringGotData($string) {
		if (strlen($string) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function isCookieData () {
        return false;
    }
}