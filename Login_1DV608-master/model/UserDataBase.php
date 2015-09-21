<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-09-14
 * Time: 17:27
 */

namespace model;


class UserDataBase
{
    private $users = array();
    public function addUserToDatabase(\model\User $user){
        /**
         * Checking if username already exists
         */
        if (isset($this->users[$user->getUserName()])) {
            throw new \Exception("Username already exists");
        }
        if (isset($this->users[$user->getPassword()])) {
            throw new \Exception("Password already exists");
        }

        $key = $user->getUserName();
        $this->users[$key] = $user->getPassword();

    }

    public function getUsers(){
        return $this->users;
    }
}