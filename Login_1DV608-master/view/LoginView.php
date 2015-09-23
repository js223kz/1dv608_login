<?php

namespace view;

require_once('model/UserDataBaseModel.php');


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
	private $userDBModel;

	public function __construct(\model\UserDataBaseModel $userDB){
		$this->userDBModel = $userDB;
	}

	/**
	 * method that renders login or logout html depending on
	 * $isLoggedIn true or false
	 * @param $isLoggedIn boolean
	 * @return  void, BUT writes to standard output!
	 * outputs different messages if one or both input fields are empty
	 */
	public function renderLoginLogout($loggedIn){
		$html= "";
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
		if($this->userWantsToLogin()) {
			$this->setMessage($this->userDBModel->getMessageSession());
			$this->userDBModel->destroyMessageSession();
		}
		if($loggedIn == false){
			$html = $this->renderLoginHTML();
		}else{
			$html = $this->renderLogoutHTML();
		}

		return $html;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @return  void, BUT writes to standard output!
	*/
	private function renderLogoutHTML() {
		return '
			<h2>Logged in</h2>
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $this->getMessage() .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the login view
	* @return  void, BUT writes to standard output!
	*/
	private function renderLoginHTML() {

		return '
			<h2>Not logged in</h2>
			<form method="POST">
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->getMessage() . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getUserName() . '"/>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>

		';

	}



	/**
	 * @param $message String
	 * Method sets messages to output
	 * depending on user input
	 */
	public function setMessage($message){
		$this->message = $message;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setUserName(){
		$this->username = $_POST[self::$name];
	}

	public function getUserName(){
		 return $this->username;
	}
	public function setPassword(){
		//set random string for cookie
	}

	public function getPassword(){
		return $_POST[self::$password];
	}

	/**
	 * If username field and password field are NOT empty
	 * method returns true and Logincontroller passes values on
	 * to UserModel for authentication
	 * @return bool
	 */
	public function userWantsToLogin(){
		if(isset($_POST[self::$login]) && trim($_POST[self::$password]) != '' && trim($_POST[self::$name]) != '') {
			$this->username = $_POST[self::$name];
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