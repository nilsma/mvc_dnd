<?php
/**
 * A file to construct the model, controller and view for the application's login page
 */
session_start();

require_once '../application/libs/config.php';

$model = new Logout_Model();
$ctrl = new Logout_Controller($model);

$ctrl->logout();
