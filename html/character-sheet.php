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

if(isset($_POST['update_personalia'])) {
    $segments = json_decode($_POST['update_personalia'], true);
    $ctrl->updatePersonalia($_SESSION['current_sheet'], $segments);
}

if(isset($_POST['update_stats'])) {
    $segments = json_decode($_POST['update_stats'], true);
    $ctrl->updateStats($_SESSION['current_sheet'], $segments);
}

if(isset($_POST['update_armor_class'])) {
    $segments = json_decode($_POST['update_armor_class'], true);
    $ctrl->updateArmorClass($_SESSION['current_sheet'], $segments);
}

if(isset($_POST['update_attribute'])) {
    $segments = json_decode($_POST['update_attribute'], true);
    $ctrl->updateAttribute($_SESSION['current_sheet'], $segments, strtolower($_POST['update_attribute_label']));
}

if(isset($_POST['update_saving_throw'])) {
    $segments = json_decode($_POST['update_saving_throw'], true);
    $ctrl->updateSavingThrow($_SESSION['current_sheet'], $segments, strtolower($_POST['update_saving_throw_label']));
}

if(isset($_POST['update_attacks'])) {
    $segments = json_decode($_POST['update_attacks'], true);
    $ctrl->updateAttacks($_SESSION['current_sheet'], $segments);
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
    if(!empty($_POST['special_ability_search_template']) && !empty($_POST['special_ability_search_input'])) {
        $ctrl->addSpecialAbility($_SESSION['current_sheet'], $_POST['special_ability_search_template']);
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

if(isset($_POST['add_protective_item'])) {
    $ctrl->addProtectiveItem($_SESSION['current_sheet']);
    header('Location: character-sheet.php');
    exit();
}

if(isset($_POST['remove_protective_item'])) {
    $ctrl->removeProtectiveItem($_SESSION['current_sheet'], $_POST['remove_protective_item']);
}

if(isset($_POST['remove_item'])) {
    $ctrl->removeItem($_SESSION['current_sheet'], $_POST['remove_item']);
}

if(isset($_POST['remove_attack'])) {
    $ctrl->removeAttack($_SESSION['current_sheet'], $_POST['remove_attack']);
}

if(isset($_POST['remove_feat'])) {
    $ctrl->removeFeat($_SESSION['current_sheet'], $_POST['remove_feat']);
}

if(isset($_POST['remove_special_ability'])) {
    $ctrl->removeSpecialAbility($_SESSION['current_sheet'], $_POST['remove_special_ability']);
}

if(isset($_POST['remove_language'])) {
    $language = strtolower($_POST['remove_language']);
    $ctrl->removeLanguage($_SESSION['current_sheet'], $language);
}

if(isset($_POST['remove_currency'])) {
    $ctrl->removeCurrency($_SESSION['current_sheet'], $_POST['remove_currency']);
}

if(isset($_POST['get_special_abilities_suggestions'])) {
    $suggestions_array = $ctrl->getSpecialAbilitiesSuggestions($_POST['get_special_abilities_suggestions']);
    $view->getSpecialAbilitySuggestionsHTML($suggestions_array);
}

if(isset($_POST['get_feat_suggestions'])) {
    $suggestions_array = $ctrl->getFeatSuggestions($_POST['get_feat_suggestions']);
    $view->getFeatSuggestionsHTML($suggestions_array);
}

if(isset($_POST['feat_info'])) {
    $view->getFeatInfo($_POST['feat_info']);
}

if(isset($_POST['special_ability_info'])) {
    $view->getSpecialAbilityInfo($_POST['special_ability_info']);
}

$character_sheet = $ctrl->getCharacterSheet($_SESSION['current_sheet']);

if(!isset($_POST['add_attack']) &&
    !isset($_POST['add_item']) &&
    !isset($_POST['add_protective_item']) &&
    !isset($_POST['add_language']) &&
    !isset($_POST['add_currency']) &&
    !isset($_POST['remove_attack']) &&
    !isset($_POST['remove_protective_item']) &&
    !isset($_POST['remove_feat']) &&
    !isset($_POST['remove_language']) &&
    !isset($_POST['remove_special_ability']) &&
    !isset($_POST['remove_currency']) &&
    !isset($_POST['update_personalia']) &&
    !isset($_POST['update_stats']) &&
    !isset($_POST['update_armor_class']) &&
    !isset($_POST['update_attribute']) &&
    !isset($_POST['update_saving_throw']) &&
    !isset($_POST['update_attacks']) &&
    !isset($_POST['feat_info']) &&
    !isset($_POST['get_feat_suggestions']) &&
    !isset($_POST['special_ability_info']) &&
    !isset($_POST['get_special_abilities_suggestions'])) {
    $view->render($character_sheet);
}