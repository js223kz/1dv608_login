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

class LoginController
{
    private $view;
    private $model;

    public function __construct(\LoginView $view, \model\User $model){
        $this->view = $view;
        $this->model = $model;
    }

    public function authenticateUser(){
        $startAuthentication = $this->view->startAuthenticateUser();
       if($startAuthentication==true){
           $username = $this->view->getUserName();
           $password = $this->view->getPassword();

           $response = $this->model->authenticateUser($username, $password);

           var_dump($response);

       }else{

       }

    }

}