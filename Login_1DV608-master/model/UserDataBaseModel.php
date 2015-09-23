<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-09-14
 * Time: 17:27
 */

namespace model;


class UserDataBaseModel
{
    private $users = array();
    private $userLoggedInSession = "loggedIn";
    private $messageSession = "message";

    public function addUserToDatabase(\model\User $user){

         //Checking if username already exists
        if (isset($this->users[$user->getUserName()])) {
            throw new \Exception("Username already exists");
        }
        else if (isset($this->users[$user->getPassword()])) {
            throw new \Exception("Password already exists");
        }else{
            //saving to "database with username as index key"
            $key = $user->getUserName();
            $this->users[$key] = $user->getPassword();
        }
    }

    public function getUsers(){
        return $this->users;
    }
    public function isLoggedIn(){
        if(isset($_SESSION[$this->userLoggedInSession])){
            return true;
        }else{
            return false;
        }
    }

    private function setUserLoggedInSession()
    {
        if(!isset($_SESSION[$this->userLoggedInSession])) {
            $_SESSION[$this->userLoggedInSession] = true;
        }
    }

    public function unsetUserLoggedInSession()
    {
        if(isset($_SESSION[$this->userLoggedInSession])) {
            unset($_SESSION[$this->userLoggedInSession]);
        }
    }

    private function setMessageSession($message){

        $_SESSION[$this->messageSession] = $message;
    }

    public function getMessageSession(){
        if(isset($_SESSION[$this->messageSession])) {
            return $_SESSION[$this->messageSession];
        }
    }

    public function destroyMessageSession()
    {
        unset($_SESSION[$this->messageSession]);
    }
    /**
    * Checks username and password against "userdatabase"
     * @param UserDataBase $userDB
     * @return string used in setMessage in Logincontroller
     */
    public function checkUserCredentials($username, $password){
        if(empty($username) || empty($password)){
            throw new \Exception("Username and password can't be empty!");
        }

        $users = $this->getUsers();

        if (array_key_exists($username, $users)) {

            if($users[$username] === $password){
                $this->setUserLoggedInSession();
                $this->setMessageSession("Welcome");
            }else{
                $this->setMessageSession("Wrong name or password");
            }
        }else{
            $this->setMessageSession("Wrong name or password");
        }
    }

}