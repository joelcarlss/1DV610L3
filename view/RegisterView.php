<?php

namespace view;
use Exception;

class RegisterView {
	private $registerLink = 'register';
	private $name = 'RegisterView::UserName';
	private $password = 'RegisterView::Password';
	private $passwordConfirmation = 'RegisterView::PasswordRepeat';
	private $messageId = 'RegisterView::Message';
	private $register = 'RegisterView::Register';

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
					<p id="' . $this->messageId . '">' . $message . '</p>
					
					<label for="' . $this->name . '">Username :</label>
					<input type="text" id="' . $this->name . '" name="' . $this->name . '" value="" />

					<label for="' . $this->password . '">Password :</label>
					<input type="password" id="' . $this->password . '" name="' . $this->password . '" />

					<label for="' . $this->passwordConfirmation . '">Confirm Password :</label>
					<input type="password" id="' . $this->passwordConfirmation . '" name="' . $this->passwordConfirmation . '" />
					
					<input type="submit" name="' . $this->register . '" value="Register" />
				</fieldset>
			</form>
		';
	}
	
	public function setMessage($message) {
		$this->message = $message;
	}
	public function isRegistering() {
            if (!empty($_GET)) {
                if(isset($_GET[$this->registerLink])) {
                return true;
            }
        }
        return false;
    }
    
    
    public function isRegisterPost() {
        return $this->postIsType($this->register);
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
	 * Gets username value
	 * @return string
	 */
	public function getRequestUserName() {
        // TODO, STRLEN Throw??
		return $_POST[$this->name];
	}

	/**
	 * Gets password value
	 * @return string
	 */
	public function getRequestPassword() {
        // TODO, STRLEN Throw??
		return $_POST[$this->password];
	}
    /**
	 * Gets password confirmation value
	 * @return string
	 */
	public function getRequestPasswordConfirmation() {
		return $_POST[$this->passwordConfirmation];
    }
    public function getUsernameLength () {
        return strlen($_POST[$this->name]);
    }
    public function getPasswordLength () {
        return strlen($_POST[$this->password]);
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