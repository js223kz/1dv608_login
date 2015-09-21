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
    private $userDataBaseModel;
    private $isUserAuthenticated = false;

    public function __construct($userName, $passWord){
        $this->userName = $userName;
        $this->passWord = $passWord;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getPassword(){
        return $this->passWord;
    }

    public function authenticateUser(UserDataBase $userDB){
        $this->userDataBaseModel = $userDB;
        $users = $this->userDataBaseModel->getUsers();

        if (array_key_exists($this->userName, $users)) {

            if($users[$this->userName] === $this->passWord){
                $this->isUserAuthenticated = true;
                return "Welcome";
            }else{
                $this->isUserAuthenticated = false;
                return "Wrong name or password";
            }
        }else{
            $this->isUserAuthenticated = false;
            return "Wrong name or password";
        }

    }

    public function getIsUserLoggedIn(){
        return $this->isUserAuthenticated;
    }





}