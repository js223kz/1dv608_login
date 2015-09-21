<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('model/UserDataBase.php');
require_once('controller/LoginController.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE NEW USER OBJECT
$user = new \model\User("Admin", "Password");
$userDB = new \model\UserDataBase();
$userDB->addUserToDatabase($user);

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();

$loginController = new \controller\LoginController($v, $userDB);
$loginController->authenticateUser();

$lv->render($loginController->isUserLoggedIn(), $v, $dtv);



