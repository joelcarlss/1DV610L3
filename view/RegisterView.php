<?php

namespace view;
use Exception;

class RegisterView {
	private static $registerLink = 'register';
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordConfirmation = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';
	private static $register = 'RegisterView::Register';

	private $userName;
	private $userPassword;
	private $minimumNameLength = 3;
	private $minimumPasswordLength = 6;
	private $message = '';



	/**
	 * Creates a HTTP-Response for register page.
	 * @return string 
	 */
	public function response() {
		
		$response = $this->generateLRegisterFormHTML($this->message);
		//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}
	
	/**
	* Generate HTML code for register form
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLRegisterFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Register - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$passwordConfirmation . '">Confirm Password :</label>
					<input type="password" id="' . self::$passwordConfirmation . '" name="' . self::$passwordConfirmation . '" />
					
					<input type="submit" name="' . self::$register . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function setMessage($message) {
		$this->message = $message;
	}
	public function getIsRegistering() {
            if (!empty($_GET)) {
                if(isset($_GET[self::$registerLink])) {
                return true;
            } else {
                return false;
            }
	    }
	}

	/**
	 * Gets username value if any
	 * @return string
	 */
	public function getRequestUserName() {
		return $_POST[self::$name];
	}

	/**
	 * Gets password value if any
	 * @return string
	 */
	public function getRequestPassword() {
		return $_POST[self::$password];
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
   * Checks length of string if string
   * @return integer length of string
   */
  private function checkStringLength ($string) {
    if (is_string($string)) {
      return count($string);
    }
  }
}