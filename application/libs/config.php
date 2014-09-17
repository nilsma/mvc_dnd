<?php
/**
 * A file to hold the application's central configurations
 */

/**
 * constants
 */
define("NO_OF_SPECIAL_ABILITIES", 10);
define("NO_OF_FEATS", 10);
define("NO_OF_INVENTORY_ITEMS", 20);
define("NO_OF_PROTECTIVE_ITEMS", 2);
define("NO_OF_LANGUAGES", 6);

/**
 * includes
 */
require_once '../application/libs/utils.class.php';
require_once '../application/libs/character-sheet.class.php';
require_once '../application/libs/personalia.class.php';
require_once '../application/libs/armor-class.class.php';
require_once '../application/libs/stats.class.php';
require_once '../application/libs/attacks.class.php';
require_once '../application/libs/grapple.class.php';
require_once '../application/libs/attack.class.php';
require_once '../application/libs/attribute.class.php';
require_once '../application/libs/skills.class.php';
require_once '../application/libs/skill-template.class.php';
require_once '../application/libs/skill.class.php';
require_once '../application/libs/purse.class.php';
require_once '../application/libs/languages.class.php';
require_once '../application/libs/special-abilities.class.php';
require_once '../application/libs/feats.class.php';
require_once '../application/libs/inventory.class.php';
require_once '../application/libs/item.class.php';
require_once '../application/libs/saving-throw.class.php';
require_once '../application/libs/saving-throws.class.php';
require_once '../application/libs/armors.class.php';
require_once '../application/libs/armor.class.php';
require_once '../application/libs/shield.class.php';
require_once '../application/libs/protective-item.class.php';

require_once '../application/models/base.model.php';
require_once '../application/models/login.model.php';
require_once '../application/models/register.model.php';
require_once '../application/models/member.model.php';
require_once '../application/models/create-character.model.php';
require_once '../application/models/character-sheet.model.php';
require_once '../application/models/logout.model.php';

require_once '../application/controllers/base.controller.php';
require_once '../application/controllers/login.controller.php';
require_once '../application/controllers/register.controller.php';
require_once '../application/controllers/member.controller.php';
require_once '../application/controllers/create-character.controller.php';
require_once '../application/controllers/character-sheet.controller.php';
require_once '../application/controllers/logout.controller.php';

require_once '../application/views/base.view.php';
require_once '../application/views/login.view.php';
require_once '../application/views/about.view.php';
require_once '../application/views/register.view.php';
require_once '../application/views/member.view.php';
require_once '../application/views/create-character.view.php';
require_once '../application/views/character-sheet.view.php';

/**
 * PHP configuration * enable error reporting
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Charset settings
 * specifically used for html() function in the utils class
 */
define('CHARSET', 'UTF-8');
define('REPLACE_FLAGS', ENT_COMPAT | 'UTF-8');