<?php
/**
 * A file to hold the application's central configurations
 */

/**
 * includes
 */
require_once '../application/libs/utils.class.php';

require_once '../application/classes/personalia.class.php';
require_once '../application/classes/armor-class.class.php';
require_once '../application/classes/armor.class.php';
require_once '../application/classes/special-ability.class.php';
require_once '../application/classes/character-sheet.class.php';
require_once '../application/classes/stats.class.php';
require_once '../application/classes/attacks.class.php';
require_once '../application/classes/grapple.class.php';
require_once '../application/classes/attack.class.php';
require_once '../application/classes/attribute.class.php';
require_once '../application/classes/skills.class.php';
require_once '../application/classes/skill-template.class.php';
require_once '../application/classes/skill.class.php';
require_once '../application/classes/purse.class.php';
require_once '../application/classes/languages.class.php';
require_once '../application/classes/special-abilities.class.php';
require_once '../application/classes/feats.class.php';
require_once '../application/classes/feat.class.php';
require_once '../application/classes/inventory.class.php';
require_once '../application/classes/item.class.php';
require_once '../application/classes/saving-throw.class.php';
require_once '../application/classes/saving-throws.class.php';
require_once '../application/classes/armors.class.php';
require_once '../application/classes/shield.class.php';
require_once '../application/classes/protective-item.class.php';
require_once '../application/classes/currency.class.php';

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
 * constants
 */
define("NO_OF_PROTECTIVE_ITEMS", 2);
define("MIN_NO_OF_ATTACKS", 1);
define("MIN_NO_OF_PROTECTIVE_ITEMS", 1);
define("MIN_NO_OF_INVENTORY_ITEMS", 5);
define("CURRENCIES", serialize(array('gold', 'silver', 'copper')));

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