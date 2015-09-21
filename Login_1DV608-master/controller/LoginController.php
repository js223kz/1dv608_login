<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-09-14
 * Time: 11:44
 */


namespace controller;
require_once('view/LoginView.php');
require_once('model/User.php');
require_once('model/UserDataBase.php');

class LoginController
{
    private $view;
    private $userModel;
    private $userDBModel;
    private $userIsLoggedIn;

    public function __construct(\LoginView $view, \model\UserDataBase $userDB){
        $this->view = $view;
        $this->userDBModel = $userDB;
        //$this->view->unSetSession();

    }

    public function authenticateUser(){
        if($this->view->isSessionActive() == true){
            $this->userIsLoggedIn = true;
        }else if($this->view->userWantsToLogin() == true){
            $username = $this->view->getUserName();
            $password = $this->view->getPassword();
            $this->userModel =  new \model\User($username, $password);
            $this->view->setMessage($this->userModel->authenticateUser($this->userDBModel));

            if($this->userModel->getIsUserLoggedIn() == true){

                $this->view->setSession();
                $this->userIsLoggedIn = true;
            }

        }else if($this->view->logout() == true){
            var_dump("inne i logout");
            $this->view->unSetSession();
            $this->userIsLoggedIn = false;
        }else{
            $this->userIsLoggedIn = false;
        }
    }

    public function isUserLoggedIn(){
       return $this->userIsLoggedIn;
    }
}