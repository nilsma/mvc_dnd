<?php
/**
 * A file to start a session for the user and move them to the login page
 */

session_start();

header('Location: login.php');