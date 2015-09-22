<?php

//INCLUDE THE FILES NEEDED...
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('model/UserDataBase.php');
require_once('controller/LoginController.php');

session_start();

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE NEW USER OBJECT
$user = new \model\User("Admin", "Password");


//ADDING USER OBJECT TO FAKE "DATABASE"
$userDB = new \model\UserDataBase();
$userDB->addUserToDatabase($user);

//CREATE OBJECTS OF THE VIEWS
$dtv = new DateTimeView();
$lv = new LayoutView();

$loginController = new \controller\LoginController($userDB);

$loginController->authenticateUser();
$htmlBody = $loginController->renderBodyHTML();

$lv->render($htmlBody, $dtv);



