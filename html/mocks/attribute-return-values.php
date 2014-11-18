<?php

$data = file_get_contents("php://input");

$data_array = json_decode($data, true);

$items_array = array(
    array(15, 'bedroll', 1, 5.0),
    array(17, 'candles', 10, 0.1),
    array(18, 'healing potions', 10, 0.25),
    array(19, 'day rations', 14, 0.75),
    array(20, 'spell book', 1, 2)
);

$skills_array = array(
    array('appraise', 'appraise', 'INT', 3, 1, 0, 4),
    array('balance', 'balance', 'DEX', 2, 4, 0, 6),
    array('bluff', 'bluff', 'CHA', 5, 7, 0, 12),
    array('concentration', 'concentration', 'CON', 2, 1, 0, 3),
    array('decipher-script', 'decipher script', 'INT', 3, 2, 0 , 5)
);

$return_array = array(
    'strength' => 10,
    'constitution' => 18,
    'dexterity' => 14,
    'intelligence' => 16,
    'wisdom' => 18,
    'charisma' => 20,
    'str_temp' => 0,
    'con_temp' => 0,
    'dex_temp' => 0,
    'int_temp' => 0,
    'wis_temp' => 0,
    'cha_temp' => 0,
    'fortitude_base_save' => 11,
    'fortitude_magic_mod' => 4,
    'fortitude_misc_mod' => 5,
    'fortitude_temp_mod' =>6,
    'reflex_base_save' => 11,
    'reflex_magic_mod' => 4,
    'reflex_misc_mod' => 5,
    'reflex_temp_mod' =>6,
    'will_base_save' => 11,
    'will_magic_mod' => 4,
    'will_misc_mod' => 5,
    'will_temp_mod' => 6,
    'skill_ranks' => 1,
    'skill_misc_mod' => 1,
    'skills_array' => $skills_array,
    'items_array' => $items_array
);

if(isset($data_array['action'])) {
    echo json_encode($return_array, JSON_FORCE_OBJECT);
} else {
    echo 'dang nabbit!';
}
