<?php

namespace view;

class DashBoard {


	private $messageId = 'LoginView::Message';
	private $logout = 'LoginView::Logout';

	private $loginMessage = 'Welcome';
	private $loginRememberMessage = 'Welcome and you will be remembered';
	private $loginCookieMessage = 'Welcome back with cookie';

	private $message = '';
	/**
	 * Create HTTP response
	 * @return  string with HTML
	 */
	public function response() {
		
		$response = $this->generateLogoutButtonHTML();
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return string with HTML
	*/
	private function generateLogoutButtonHTML() {
		return '
			<form  method="post" >
				<p id="' . $this->messageId . '">' . $this->message .'</p>
				<input type="submit" name="' . $this->logout . '" value="logout"/>
			</form>
		';
	}

	public function isLogOutAttempt() {
		if (!empty($_POST)) {
			if (isset($_POST[$this->logout])) { 
				return true; 
			}
		}
		return false;
	}
	
}