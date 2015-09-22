<?php

class LoginView {

	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $username = "";
	private $message = "";
	private $sessionLocation = "userName";


	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isUserLoggedIn) {
		$response="";

		if(isset($_POST[self::$login]) && trim($_POST[self::$name]) == '' && trim($_POST[self::$name]) == '')
		{
			$this->setMessage('Username is missing');
		}
		if(isset($_POST[self::$login]) && trim($_POST[self::$name]) != '' && trim($_POST[self::$password]) == '')
		{
			$this->username = $_POST[self::$name];
			$this->setMessage('Password is missing');
		}
		if(isset($_POST[self::$login]) && trim($_POST[self::$password]) != '' && trim($_POST[self::$name]) == '')
		{
			$this->setMessage('Username is missing');
		}
		if($isUserLoggedIn==false){
			$response = $this->generateLoginFormHTML($this->getMessage());
		}else{
			$response .= $this->generateLogoutButtonHTML($this->getMessage());
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	public function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML() {

		return '
			<form method="post" action="" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->getMessage() . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->username . '"/>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>

			</form>

		';

	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function getMessage(){
		return $this->message;
	}

	public function getUserName(){
		 return $_POST[self::$name];
	}

	public function getPassword(){
		return $_POST[self::$password];
	}

	public function userWantsToLogin(){

		if(isset($_POST[self::$login]) && trim($_POST[self::$password]) != '' && trim($_POST[self::$name]) != '') {
			$this->username = $_POST[self::$name];
			return true;
		}else{
			return false;
		}
	}

	public function setSession()
	{
		if(isset($_POST[self::$keep])) {

			$_SESSION[$this->sessionLocation] = $this->getUserName();
		}
	}

	public function unSetSession()
	{
		if(isset($_SESSION[$this->sessionLocation])) {
			session_destroy();
			unset($_SESSION[$this->sessionLocation]);
		}
	}

	public function isSessionActive(){
		if(isset($_SESSION[$this->sessionLocation])){
			return true;
		}else{
			return false;
		}
	}

	public function logout(){
		if(isset($_POST[self::$logout])){
			return true;
		}else{
			return false;
		}
	}
}