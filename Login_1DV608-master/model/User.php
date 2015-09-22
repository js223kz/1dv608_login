<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-09-14
 * Time: 17:03
 */

namespace model;


class User
{
    private $userName;
    private $passWord;
    private $loggedIn = false;

    public function __construct($userName, $passWord){
        if(empty($userName) || empty($passWord)){
            throw new \Exception("Username/password can´ be empty");
        }else{
            $this->userName = $userName;
            $this->passWord = $passWord;
        }
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getPassword(){
        return $this->passWord;
    }

    public function authenticateUser(UserDataBase $userDB){
        $users = $userDB->getUsers();

        if (array_key_exists($this->userName, $users)) {

            if($users[$this->userName] === $this->passWord){
                $this->loggedIn = true;
                return "Welcome";
            }else{
                $this->loggedIn = false;
                return "Wrong name or password";
            }
        }else{
            $this->loggedIn = false;
            return "Wrong name or password";
        }

    }

    public function isUserLoggedIn(){
        return $this->loggedIn;
    }
}