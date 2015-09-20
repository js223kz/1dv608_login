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
        if (array_key_exists($this->userName, $this->userDataBaseModel->getUsers())) {
            return "Username exists";
        }else{
            return "Username does not exists";
        }
    }



}