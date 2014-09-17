<?php
/**
* A file to construct the model, controller and view for the application's login page
*/
session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: index.php');
}

require_once '../application/libs/config.php';

$model = new Create_Character_Model();
$ctrl = new Create_Character_Controller($model);
$view = new Create_Character_View($model, $ctrl, 'MVC DND', 'create_character');

if(isset($_POST['submit'])) {
    //$ctrl->registerCharacter($_POST);
    header('Location: create_character.php');
    exit();
}

$view->render();

