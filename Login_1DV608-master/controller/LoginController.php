<?php
/**
 * Created by PhpStorm.
 * User: mkt
 * Date: 2015-09-14
 * Time: 11:44
 */


namespace controller;
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/UserDataBaseModel.php');

class LoginController
{
    private $loginView;
    private $layoutView;
    private $dateTimeView;
    private $userDBModel;

    public function __construct(\model\UserDataBaseModel $userDB){

        $this->loginView = new \view\LoginView($userDB);
        $this->layoutView = new \view\LayoutView();
        $this->dateTimeView = new \view\DateTimeView();
        $this->userDBModel = $userDB;
    }

    public function authenticateUser(){

        if($this->loginView->userWantsToLogin() && !$this->userDBModel->isLoggedIn()){
            $username = $this->loginView->getUserName();
            $password = $this->loginView->getPassword();

            try {
                $this->userDBModel->checkUserCredentials($username, $password);

            } catch (Exception $e) {
                $this->loginView->setMessage($e->getMessage());
            }
        }
      if($this->loginView->logout() && $this->userDBModel->isLoggedIn()){
          $this->loginView->setMessage("Bye bye!");
          $this->userDBModel->unsetUserLoggedInSession();
       }
    }
    public function echoHTML(){
        $loginViewHTML = $this->loginView->renderLoginLogout($this->userDBModel->isLoggedIn());

        $this->layoutView->render($loginViewHTML, $this->dateTimeView);
    }
}