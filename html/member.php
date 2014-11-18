<?php
/**
 * A file to construct the model, controller and view for the application's login page
 */
session_start();

if(!isset($_SESSION['auth'])) {
    header('Location: index.php');
}

if(!isset($_SESSION['auth'])) {
    header('Location: index.php');
}

require_once '../application/libs/config.php';

$model = new Member_Model();
$ctrl = new Member_Controller($model);
$view = new Member_View($model, $ctrl, 'MVC DND', 'member');

if(isset($_POST['submit_character'])) {
    $ctrl->loadCharacter($_POST['sheet_id']);
    header('Location: character-sheet.php');
    exit();
}

$view->render();