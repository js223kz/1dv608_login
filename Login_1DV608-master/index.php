<?php

//INCLUDE THE FILES NEEDED...
require_once('model/User.php');
require_once('model/UserDataBaseModel.php');
require_once('controller/LoginController.php');

session_start();

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE NEW USERDATABASE FAKE OBJECT
$userDB = new \model\UserDataBaseModel();

//CREATE NEW USER OBJECT AND ADD IT TO FAKE DATABASE
try {
    $user = new \model\User("Admin", "Password");
    $userDB->addUserToDatabase($user);

} catch (Exception $e) {
    echo $e->getMessage() ."\n";
}

$loginController = new \controller\LoginController($userDB);

$loginController->authenticateUser();
$loginController->echoHTML();



