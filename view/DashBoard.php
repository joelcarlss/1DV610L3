<?php

namespace view;
require_once('view/Messages.php');

class DashBoard {


	private $messageId = 'LoginView::Message';
	private $logout = 'LoginView::Logout';

	private $message = '';
	/**
	 * Create HTTP response
	 * @return  string with HTML
	 */
	public function response() : string {
		
		$response = $this->generateLogoutButtonHTML();
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return string with HTML
	*/
	private function generateLogoutButtonHTML() : string {
		return '
			<form  method="post" >
				<p id="' . $this->messageId . '">' . $this->message .'</p>
				<input type="submit" name="' . $this->logout . '" value="logout"/>
			</form>
		';
	}

	public function setMessage ($message) {
		$this->message = $message;
	}

	public function isLogOutAttempt() : bool {
		if (!empty($_POST)) {
			if (isset($_POST[$this->logout])) { 
				return true; 
			}
		}
		return false;
	}
	
}