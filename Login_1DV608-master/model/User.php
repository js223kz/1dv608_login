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

    public function authenticateUser(){
        return "function running";
    }



}