<?php

namespace view;

class DashBoard {

	private $loginMessage = 'Welcome';
	private $loginRememberMessage = 'Welcome and you will be remembered';
	private $loginCookieMessage = 'Welcome back with cookie';

	/**
	 * Create HTTP response
	 * @return  string with HTML
	 */
	public function response() {
		$message = '';
		
		$response = $this->generateLogoutButtonHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return string with HTML
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	public function isLogOutAttempt() {
		return false;
	}
	
}