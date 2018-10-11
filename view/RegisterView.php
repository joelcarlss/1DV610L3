<?php

namespace view;
use Exception;
require_once('view/Messages.php');

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
	public function response() : string {
		
		$response = $this->generateLRegisterFormHTML($this->message);
		//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}
	
	/**
	* Generate HTML code for register form
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLRegisterFormHTML($message) : string {
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
	
	public function setMessage($message) : void {
		$this->message .= $message;
	}
	public function isRegistering() : bool {
            if (!empty($_GET)) {
                if(isset($_GET[$this->registerLink])) {
                return true;
            }
        }
        return false;
    }
    
    
    public function isRegisterPost() : bool {
        return $this->postIsType($this->register);
    }
	/**
	 * Checks if post type is similar to argument.
	 * @return bool
	 */
	private function postIsType($type) : bool {
		if (!empty($_POST)) {
			if (isset($_POST[$type])) { 
				return true; 
			}
		}
		return false;
	}

	// GET USERNAME FUNCTIONALITY

	/**
	 * Gets username entered in post
	 * @return string username
	 * @throws exception if length is to short
	 */
	public function getUsername () : string {
		if ($this->isUsernameValid()) {
			return $this->getRequestUserName();
		}
	}
	private function isUsernameValid () : bool {
		$username = $_POST[$this->name];

        if (strlen($username) < $this->minimumNameLength) {
			throw new Exception($this->usernameLengthMessage);
		} else {
			return true;
		}
	}
	/**
	 * Gets username value
	 * @return string
	 */
	private function getRequestUserName() : string {
		return $_POST[$this->name];
	}

	// GET PASSWORD FUNCTIONALITY

	/**
	 * Gets password entered in post
	 * @return string password
	 * @throws exception if length is to short
	 */
	public function getPassword () : string {
			if ($this->isPasswordValid()) {
				return $this->getRequestPassword();
			}
	}

	private function isPasswordValid () : bool {
		$password = $_POST[$this->password];
		$passwordConfirmation = $this->getRequestPasswordConfirmation();

        if (strlen($password) < $this->minimumPasswordLength) {
			throw new Exception($this->passwordLengthMessage);
		} else if ($passwordConfirmation != $password) {
			throw new Exception($this->passwordMatchErrorMessage);
		}else {
			return true;
		}
	}

	/**
	 * Gets password value
	 * @return string
	 */
	public function getRequestPassword() : string {
		return $_POST[$this->password];
	}
    /**
	 * Gets password confirmation value
	 * @return string
	 */
	private function getRequestPasswordConfirmation() : string {
		return $_POST[$this->passwordConfirmation];
	}
	


  /**
   * Checks length of string if string
   * @return integer length of string
   */
  private function checkStringLength ($string) : int {
    if (is_string($string)) {
      return count($string);
    }
  }
}