<?php
/**
 * A file to construct the model, controller and view for the application's login page
 */
session_start();

require_once '../application/libs/config.php';

$model = new Character_Sheet_Model();
$ctrl = new Character_Sheet_Controller($model);
$view = new Character_Sheet_View($model, $ctrl, 'MVC DND', 'character-sheet');

$session_var_to_clear = array('creation_array', 'languages_array', 'currencies_array',
    'no_of_protective_items', 'no_of_attacks', 'feats_array', 'special_abilities_array'
);

foreach($session_var_to_clear as $var) {
    if(isset($_SESSION[$var])) {
        $_SESSION[$var] = false;
        unset($_SESSION[$var]);
    }
}

if(!isset($_SESSION['spell_search_class'])) {
    $_SESSION['spell_search_class'] = "barbarian";
}

if(!isset($_SESSION['spell_search_level'])) {
    $_SESSION['spell_search_level'] = 10;
}

if(isset($_POST['action'])) {
    $ctrl->parseAction($view, $_SESSION['current_sheet'], $_POST);
}

if(isset($_POST['add_language'])) {
    $ctrl->addLanguage($_SESSION['current_sheet'], $_POST['new_language']);
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_currency'])) {
    $ctrl->addCurrency($_SESSION['current_sheet'], $_POST['new_currency']);
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_item'])) {
    $ctrl->addItem($_SESSION['current_sheet']);
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_attack'])) {
    $ctrl->addAttack($_SESSION['current_sheet']);
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_special_ability'])) {
    if(!empty($_POST['special_ability_search_template']) &&
        !empty($_POST['special_ability_search_input']) &&
        !empty($_POST['special_ability_search_base_class'])
    ) {
        $ctrl->addSpecialAbility($_SESSION['current_sheet'],
            $_POST['special_ability_search_template'],
            $_POST['special_ability_search_base_class']
        );
    }
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_feat'])) {
    if(!empty($_POST['feats_search_template']) && !empty($_POST['feats_search_input'])) {
        $ctrl->addFeat($_SESSION['current_sheet'], $_POST['feats_search_template']);
    }
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_spell'])) {
    if(!empty($_POST['spell_search_template']) && !empty($_POST['spell_search_base_class']) && !empty($_POST['spell_search_input'])) {
        $ctrl->addSpell($_SESSION['current_sheet'], $_POST['spell_search_template'], $_POST['spell_search_base_class']);
    }
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['add_protective_item'])) {
    $ctrl->addProtectiveItem($_SESSION['current_sheet']);
    header('Location: character-sheet.php');
    exit();
}

$character_sheet = $ctrl->getCharacterSheet($_SESSION['current_sheet']);

if(!isset($_POST['add_attack']) &&
    !isset($_POST['action']) &&
    !isset($_POST['add_item']) &&
    !isset($_POST['add_protective_item']) &&
    !isset($_POST['add_language']) &&
    !isset($_POST['add_feat']) &&
    !isset($_POST['add_spell']) &&
    !isset($_POST['add_currency'])) {
    $view->render($character_sheet);
}