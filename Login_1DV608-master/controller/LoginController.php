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
    private $loggedIn;

    public function __construct(\model\UserDataBase $userDB){

        $this->view = new \view\LoginView();
        $this->userDBModel = $userDB;
    }

    public function authenticateUser(){
        if($this->view->isSessionActive() == true){
            $this->loggedIn = true;
        }
        if($this->view->userWantsToLogin() == true && $this->loggedIn == false){
            $username = $this->view->getUserName();
            $password = $this->view->getPassword();

            $this->userModel =  new \model\User($username, $password);
            $this->view->setMessage($this->userModel->authenticateUser($this->userDBModel));

            if($this->userModel->isUserLoggedIn() == true){

                $this->view->setSession();
                $this->loggedIn = true;
            }

        }
        if($this->view->logout() == true && $this->loggedIn == true){
            $this->loggedIn = false;
            $this->view->unSetSession();
            $this->view->setMessage("Bye bye!");
        }
    }
    public function renderBodyHTML(){
        if($this->loggedIn != true){
            return $this->view->generateLoginFormHTML();
        }else{
            return $this->view->renderLogoutHTML();
        }
    }

}