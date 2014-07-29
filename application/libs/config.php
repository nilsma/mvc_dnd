<?php
/**
 * A file to hold the application's central configurations
 */

/**
 * includes
 */
require_once '../application/libs/utils.class.php';

require_once '../application/models/base.model.php';
require_once '../application/models/login.model.php';
require_once '../application/models/register.model.php';
require_once '../application/models/member.model.php';
require_once '../application/models/logout.model.php';

require_once '../application/controllers/base.controller.php';
require_once '../application/controllers/login.controller.php';
require_once '../application/controllers/register.controller.php';
require_once '../application/controllers/member.controller.php';
require_once '../application/controllers/logout.controller.php';

require_once '../application/views/base.view.php';
require_once '../application/views/login.view.php';
require_once '../application/views/about.view.php';
require_once '../application/views/register.view.php';
require_once '../application/views/member.view.php';

/**
 * PHP configuration
 * enable error reporting
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Charset settings
 * specifically used for html() function in the utils class
 */
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | 'UTF-8');