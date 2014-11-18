<?php

$data = file_get_contents("php://input");

$data_array = json_decode($data, true);

$skills = array(
    array('appraise', 'appraise', 'INT', 3, 1, 0, 4),
    array('balance', 'balance', 'DEX', 2, 4, 0, 6),
    array('bluff', 'bluff', 'CHA', 5, 7, 0, 12),
    array('concentration', 'concentration', 'CON', 2, 1, 0, 3),
    array('decipher-script', 'decipher script', 'INT', 3, 2, 0 , 5)
);

if(isset($data_array['action'])) {
    echo json_encode($return_array, JSON_FORCE_OBJECT);
} else {
    echo 'dang nabbit!';
}
