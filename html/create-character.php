<?php
/**
 * A file to construct the model, controller and view for the application's login page
 */
session_start();

require_once '../application/libs/config.php';

$model = new Create_Character_Model();
$ctrl = new Create_Character_Controller($model);
$view = new Create_Character_View($model, $ctrl, 'MVC DND', 'login');

if(isset($_POST['submit'])) {
    $ctrl->createCharacter();
    //$ctrl->login($_POST['username'], $_POST['password']);
    //header('Location: member.php');
    //exit();
}

$view->render();
