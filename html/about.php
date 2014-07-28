<?php
/**
 * A file to construct the model, controller and view for the application's login page
 */
session_start();

require_once '../application/libs/config.php';

$model = new Base_Model();
$ctrl = new Base_Controller($model);
$view = new About_View($model, $ctrl, 'DNDHelper', 'about');

$view->render();