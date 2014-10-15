<?php
/**
 * A file to construct the model, controller and view for the application's login page
 */
session_start();

require_once '../application/libs/config.php';

$model = new Create_Character_Model();
$ctrl = new Create_Character_Controller($model);
$view = new Create_Character_View($model, $ctrl, 'MVC DND', 'create-character');

if(isset($_POST['add_feat'])) {
    if(!empty($_POST['feats_search_template']) && !empty($_POST['feats_search_input'])) {
        $ctrl->addFeat($_POST['feats_search_template'], $_POST['feats_search_input']);
    }
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['add_special_ability'])) {
    if(!empty($_POST['special_ability_search_template']) && !empty($_POST['special_ability_search_input'])) {
        $ctrl->addSpecialAbility($_POST['special_ability_search_template'], $_POST['special_ability_search_input']);
    }
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['remove_language'])) {
    $language = Utils::washInput($_POST['remove_language']);
    $ctrl->removeLanguage($language);
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['add_language'])) {
    $language = Utils::washInput($_POST['new_language']);
    if(!empty($language)) {
        $ctrl->addLanguage($language);
    }
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['add_item'])) {
    $ctrl->addItem();
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['remove_item'])) {
    $ctrl->removeItem();
    header('Location: create-character.php');
    exit();
}

if(!isset($_SESSION['feats_array'])) {
    $_SESSION['feats_array'] = array();
}

if(!isset($_SESSION['special_abilities_array'])) {
    $_SESSION['special_abilities_array'] = array();
}

if(!isset($_SESSION['languages_array'])) {
    $_SESSION['languages_array'] = array();
}

if(!isset($_SESSION['currencies_array'])) {
    $base_currencies = $ctrl->getBaseCurrencies();
    $_SESSION['currencies_array'] = $base_currencies;
}

if(!isset($_SESSION['items_array'])) {
    $_SESSION['items_array'] = array();
}

if(isset($_POST['remove_currency'])) {
    $ctrl->removeCurrency($_POST['remove_currency']);
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['add_currency'])) {
    $currency = Utils::washInput($_POST['new_currency']);
    if(!empty($currency)) {
        $ctrl->addCurrency($currency);
    }
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['add_protective_item'])) {
    $ctrl->addProtectiveItem();
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['remove_protective_item'])) {
    $ctrl->removeProtectiveItem();
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['remove_attack'])) {
    $ctrl->removeAttack();
    header('Location: create-character.php');
    exit();
}

if(isset($_POST['add_attack'])) {
    $ctrl->addAttack();
    header('Location: create-character.php');
    exit();
}

if(!isset($_SESSION['no_of_inventory_items']) || $_SESSION['no_of_inventory_items'] < MIN_NO_OF_INVENTORY_ITEMS) {
    $_SESSION['no_of_inventory_items'] = MIN_NO_OF_INVENTORY_ITEMS;
}

if(!isset($_SESSION['no_of_protective_items']) || $_SESSION['no_of_protective_items'] < MIN_NO_OF_PROTECTIVE_ITEMS) {
    $_SESSION['no_of_protective_items'] = MIN_NO_OF_PROTECTIVE_ITEMS;
}

if(!isset($_SESSION['no_of_attacks']) || $_SESSION['no_of_attacks'] < MIN_NO_OF_ATTACKS) {
    $_SESSION['no_of_attacks'] = MIN_NO_OF_ATTACKS;
}

if(isset($_POST['get_feat_suggestions'])) {
    $suggestions_array = $ctrl->getFeatSuggestions($_POST['get_feat_suggestions']);
    $view->getFeatSuggestionsHTML($suggestions_array);
}

if(isset($_POST['get_special_abilities_suggestions'])) {
    $suggestions_array = $ctrl->getSpecialAbilitiesSuggestions($_POST['get_special_abilities_suggestions']);
    $view->getSpecialAbilitySuggestionsHTML($suggestions_array);
}

if(isset($_POST['special_ability_info'])) {
    $view->getSpecialAbilityInfo($_POST['special_ability_info']);
}

if(isset($_POST['feat_info'])) {
    $view->getFeatInfo($_POST['feat_info']);
}

if(isset($_POST['load_special_ability']) && !empty($_POST['load_special_ability'])) {
    $ctrl->loadSpecialAbility($_POST['load_special_ability']);
}

if(isset($_POST['load_feat']) && !empty($_POST['load_feat'])) {
    $ctrl->loadFeat($_POST['load_feat']);
}

if(isset($_POST['unload_special_ability']) && !empty($_POST['unload_special_ability'])) {
    $ctrl->unloadSpecialAbility($_POST['unload_special_ability']);
}

if(isset($_POST['unload_feat']) && !empty($_POST['unload_feat'])) {
    $ctrl->unloadFeat($_POST['unload_feat']);
}

if(isset($_POST['submit'])) {
    $_SESSION['current_sheet'] = $ctrl->createCharacter($_SESSION['user_id']);
    header('Location: character-sheet.php');
    exit();
}

if(!isset($_POST['special_ability_info']) &&
    !isset($_POST['get_special_abilities_suggestions']) &&
    !isset($_POST['feat_info']) &&
    !isset($_POST['get_new_attack_html']) &&
    !isset($_POST['add_item']) &&
    !isset($_POST['get_feat_suggestions'])) {
    $view->render();
}