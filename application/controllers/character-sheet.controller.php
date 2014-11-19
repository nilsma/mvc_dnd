<?php
/**
 * A controller class file for the character-sheet page
 */

if(!class_exists('Character_Sheet_Controller')) {

    class Character_Sheet_Controller extends Base_Controller {

        public function __construct(Character_Sheet_Model $model) {
            $this->model = $model;
            parent::__construct($model);
        }

        public function parseAngularAction($view, $sheet_id, $post_data) {
            $action = $post_data['action'];
            $segment = $post_data['segment'];
            $decode = $post_data['decode'];
            $data = $post_data['data'];

            switch($action) {
                case "select":
                    $this->handleAngularSelectAction($sheet_id, $segment);
                    break;
            }
        }

        public function handleAngularSelectAction($sheet_id, $segment) {
            $action = 'select_' . $segment;

            switch ($action) {
                case "select_stats":
                    $stats = $this->model->getStats($sheet_id);
                    $stats_return_values = json_encode($stats);
                    echo $stats_return_values;
                    break;

                case "select_protective_items":
                    $armors_id = $this->model->getArmorsId($sheet_id);
                    $protective_items = $this->model->getProtectiveItems($armors_id);
                    $protective_items_return_values = json_encode($protective_items);
                    echo $protective_items_return_values;
                    break;

                case "select_armor_class":
                    $armor_class = $this->model->getArmorClass($sheet_id);
                    $armor_class_return_values = json_encode($armor_class);
                    echo $armor_class_return_values;
                    break;

                case "select_attributes":
                    $attributes = $this->model->getAttributesAngular($sheet_id);
                    $attributes_return_values = json_encode($attributes);
                    echo $attributes_return_values;
                    break;

                case "select_saving_throws":
                    $saving_throws = $this->model->getSavingThrowsAngular($sheet_id);
                    $saving_throws_return_values = json_encode($saving_throws);
                    echo $saving_throws_return_values;
                    break;

                case "select_skills":
                    $skills_id = $this->model->getSkillsId($sheet_id);
                    $skills = $this->model->getSkillArrayAngular($skills_id);
                    $skills_return_values = json_encode($skills);
                    echo $skills_return_values;
                    break;

                case "select_items":
                    $inventory_id = $this->model->getInventoryId($sheet_id);
                    $items_array = $this->model->getItemsArray($inventory_id);
                    $items_return_values = json_encode($items_array);
                    echo $items_return_values;
                    break;

                case "select_armor":
                    $armors_id = $this->model->getarmorsId($sheet_id);
                    $armor = $this->model->getArmor($armors_id);
                    $armor_return_value = json_encode($armor);
                    echo $armor_return_value;
                    break;

                case "select_shield":
                    $armors_id = $this->model->getArmorsId($sheet_id);
                    $shield = $this->model->getShield($armors_id);
                    $shield_return_value = json_encode($shield);
                    echo $shield_return_value;
                    break;
            }
        }

        public function parseAction($view, $sheet_id, $array) {
            $action = $array['action'];
            $segment = $array['segment'];
            $data = null;

            if(isset($array['decode']) && $array['decode'] == TRUE) {
                $data = json_decode($array['data'], true);
            } else {
                $data = $array['data'];
            }

            switch($action) {
                case "update":
                    $this->handleUpdateAction($sheet_id, $segment, $data);
                    break;

                case "remove":
                    $this->handleRemoveAction($sheet_id, $segment, $data);
                    break;

                case "select":
                    $this->handleSelectAction($view, $sheet_id, $segment, $data);
                    break;

                case "set":
                    $this->handleSetAction($segment, $data);
                    break;

            }
        }

        public function handleSetAction($segment, $data) {
            $selected = "set_" . $segment;

            switch($selected) {
                case "set_spell_search_level":
                    $_SESSION['spell_search_level'] = $data['selected'];
                    break;

                case "set_spell_search_class":
                    $_SESSION['spell_search_class'] = $data['selected'];
                    break;

            }
        }

        public function handleUpdateAction($sheet_id, $segment, $data) {
            $action = "update_" . $segment;

            switch($action) {
                case "update_personalia":
                    $this->model->writePersonalia($sheet_id, new Personalia($data));
                    break;

                case "update_spell":
                    $this->model->writeSpell($sheet_id, $data);
                    break;

                case "update_stats":
                    $this->model->writeStats($sheet_id, new Stats($data));
                    break;

                case "update_armor_class":
                    $this->model->writeArmorClass($sheet_id, new Armor_Class($data));
                    break;

                case "update_attribute":
                    $this->model->writeAttribute($sheet_id, new Attribute($data), $data['name']);
                    break;

                case "update_saving_throw":
                    $this->model->writeSavingThrow($sheet_id, new Saving_Throw($data), $data['name']);
                    break;

                case "update_attacks":
                    $this->model->writeAttacks($sheet_id, $data);
                    break;

                case "update_attack":
                    $this->model->writeAttack($sheet_id, new Attack($data, $data['id']));
                    break;

                case "update_grapple":
                    $this->model->writeGrapple($sheet_id, new Grapple($data));
                    break;

                case "update_armor":
                    $this->model->writeArmor($sheet_id, new Armor($data));
                    break;

                case "update_shield":
                    $this->model->writeShield($sheet_id, new Shield($data));
                    break;

                case "update_protective_item":
                    $this->model->writeProtectiveItem($sheet_id, new Protective_Item($data, $data['protective_item_id']));
                    break;

                case "update_skills":
                    $this->model->writeSkills($sheet_id, $data);
                    break;

                case "update_skill":
                    $this->model->writeSkill($sheet_id, new Skill($data));
                    break;

                case "update_languages":
                    $this->model->writeLanguages($sheet_id, $data);
                    break;

                case "update_item":
                    $this->model->writeItem($sheet_id, new Item($data, $data['item_id']));
                    break;

                case "update_inventory":
                    $this->model->writeInventory($sheet_id, $data);
                    break;

                case "update_currency":
                    $this->model->writeCurrency($sheet_id, new Currency($data));
                    break;
            }
        }

        public function handleRemoveAction($sheet_id, $segment, $data) {
            $action = "remove_" . $segment;

            switch($action) {
                case "remove_protective_item":
                    $this->model->deleteProtectiveItem($sheet_id, $data['protective_item_id']);
                    break;

                case "remove_item";
                    $this->model->deleteItem($sheet_id, $data['item_id']);
                    break;

                case "remove_attack":
                    $this->model->deleteAttack($sheet_id, $data['attack_id']);
                    break;

                case "remove_feat":
                    $this->model->deleteFeat($sheet_id, $data['template_name']);
                    break;

                case "remove_spell":
                    $this->model->deleteSpell($sheet_id, $data['template_name']);
                    break;

                case "remove_special_ability":
                    $this->model->deleteSpecialAbility($sheet_id, $data['template_name']);
                    break;

                case "remove_language":
                    $this->model->deleteLanguage($sheet_id, strtolower($data['language']));
                    break;

                case "remove_currency":
                    $this->model->deleteCurrency($sheet_id, $data['currency']);
                    break;
            }
        }

        public function handleSelectAction($view, $sheet_id, $segment, $data) {
            $action = "select_" . $segment;

            switch($action) {

                case "select_feat_suggestions":
                    $suggestions = $this->getFeatSuggestions($data['input']);
                    $view->getFeatSuggestionsHTML($suggestions, $data['input']);
                    break;

                case "select_special_ability_suggestions":
                    $suggestions = $this->getSpecialAbilitySuggestions($data['input']);
                    $view->getSpecialAbilitySuggestionsHTML($suggestions, $data['input']);
                    break;

                case "select_spell_suggestions":
                    $suggestions = $this->getSpellSuggestions(
                        $data['input'],
                        $_SESSION['spell_search_class'],
                        $_SESSION['spell_search_level']
                    );
                    $view->getSpellSuggestionsHTML($suggestions, $data['input']);
                    break;

                case "select_special_ability_description":
                    $view->getSpecialAbilityDescription($data['template_name']);
                    break;

                case "select_feat_description":
                    $view->getFeatDescription($data['template_name']);
                    break;

                case "select_spell_description":
                    $view->getSpellDescription($data['template_name']);
                    break;

                case "select_skill_description":
                    $view->getSkillDescription($data['template_name']);
                    break;

                case "select_attributes":
                    return $this->model->getAttributes($sheet_id);
                    break;
            }

        }

        public function addSpecialAbility($sheet_id, $template_name, $base_class) {
            $this->model->insertSpecialAbility($sheet_id, $template_name, $base_class);
        }

        public function addFeat($sheet_id, $template_name) {
            $this->model->insertFeat($sheet_id, $template_name);
        }

        public function addSpell($sheet_id, $template_name, $base_class) {
            $charges = 0;
            $this->model->insertSpell($sheet_id, $template_name, $base_class, $charges);
        }

        public function addProtectiveItem($sheet_id) {
            $protective_item_entries = array(
                'protective_item_name' => '',
                'protective_item_ac_bonus' => 0,
                'protective_item_weight' => 0,
                'protective_item_special_properties' => ''
            );

            $protective_item = new Protective_Item($protective_item_entries);
            $this->model->insertProtectiveItem($sheet_id, $protective_item);
            //$_SESSION['character_variables'] = $_POST; //todo
        }

        public function addLanguage($sheet_id, $language) {
            $languages = $this->model->getLanguages($sheet_id);
            $this->model->insertLanguage($languages['languages_id'], $language);
            //$_SESSION['character_variables'] = $_POST; //todo
        }

        public function addCurrency($sheet_id, $new_currency) {
            $label = 'currency_' . $new_currency;
            $name = $new_currency;
            $amount = 0;

            $currency_entries = array('label' => $label, 'name' => $name, 'amount' => $amount);
            $currency = new Currency($currency_entries);

            $this->model->insertCurrency($sheet_id, $currency);
            //$_SESSION['character_variables'] = $_POST; //todo
        }

        public function addItem($sheet_id) {
            for($i = 0; $i < 3; $i++) {
                $item_entries = array('item_name' => '', 'item_quantity' => '', 'item_weight' => '');
                $item = new Item($item_entries);
                $this->model->insertItem($sheet_id, $item);
            }
            //$_SESSION['character_variables'] = $_POST; //todo
        }

        public function addAttack($sheet_id) {
            $attack_entries = array('attack_name' => 'Attack Name', 'attack_bonus' => 'Attack Bonus',
                'attack_damage' => 'Attack Damage', 'critical_floor' => 'Critical Floor',
                'critical_ceiling' => 'Critical Ceiling', 'weapon_range' => 'Weapon Range',
                'attack_type' => 'Attack Type', 'attack_notes' => 'Attack Notes', 'ammunition' => 'Ammunition'
            );

            $attack = new Attack($attack_entries);
            $this->model->insertAttack($sheet_id, $attack);
            //$_SESSION['character_variables'] = $_POST;
        }

        public function getCharacterSheet($sheet_id) {
            $personalia = $this->getPersonalia($sheet_id);
            $stats = $this->getStats($sheet_id);
            $attacks = $this->getAttacks($sheet_id);
            $skills = $this->getSkills($sheet_id);
            $inventory = $this->getInventory($sheet_id);
            $languages = $this->getLanguages($sheet_id);
            $armors = $this->getArmors($sheet_id);
            $attributes = $this->getAttributes($sheet_id);
            $saving_throws = $this->getSavingThrows($sheet_id);
            $feats = $this->getFeats($sheet_id);
            $special_abilities = $this->getSpecialAbilities($sheet_id);
            $currencies = $this->getCurrencies($sheet_id);
            $armor_class = $this->getArmorClass($sheet_id);
            $grapple = $this->getGrapple($sheet_id);

            $character_sheet_entries = array(
                'personalia' => $personalia,
                'stats' => $stats,
                'attacks' => $attacks,
                'skills' => $skills,
                'inventory' => $inventory,
                'languages' => $languages,
                'armors' => $armors,
                'attributes' => $attributes,
                'saving_throws' => $saving_throws,
                'feats' => $feats,
                'special_abilities' => $special_abilities,
                'currencies' => $currencies,
                'armor_class' => $armor_class,
                'grapple' => $grapple
            );

            $character_sheet = new Character_Sheet($character_sheet_entries);

            return $character_sheet;
        }

        public function getPersonalia($sheet_id) {
            $personalia = new Personalia($this->model->getPersonalia($sheet_id));
            return $personalia;
        }

        public function getStats($sheet_id) {
            $stats_segments = $this->model->getStats($sheet_id);
            $stats = new Stats($stats_segments);
            return $stats;
        }

        public function getArmorClass($sheet_id) {
            $armor_class = new Armor_Class($this->model->getArmorClass($sheet_id));
            return $armor_class;
        }

        public function getAttacks($sheet_id) {
            $attacks_segments = $this->model->getAttacks($sheet_id);

            $attacks_array = $this->getAttacksArray($attacks_segments['attacks_id']);
            $attacks_segments['attacks_array'] = $attacks_array;

            $attacks = new Attacks($attacks_segments);
            return $attacks;
        }

        public function getGrapple($sheet_id) {
            $grapple = new Grapple($this->model->getGrapple($sheet_id));
            return $grapple;
        }

        public function getAttacksArray($attacks_id) {
            $attacks = $this->model->getAttacksArray($attacks_id);
            $attacks_array = array();

            foreach($attacks as $attack_entries) {
                if(in_array('attack_id', $attack_entries)) {
                    $id = $attack_entries['attack_id'];
                } else {
                    $id = NULL;
                }

                $attack = new Attack($attack_entries, $id);
                array_push($attacks_array, $attack);
            }

            return $attacks_array;
        }

        public function getSkills($sheet_id) {
            $skills_segments = $this->model->getSkills($sheet_id);
            $skills_array = $this->getSkillsArray($skills_segments['skills_id']);
            $skills_segments['skill_array'] = $skills_array;

            $skills = new Skills($skills_segments);

            return $skills;
        }

        public function getSkillsArray($skills_id) {
            $skills_array = array();

            $skills = $this->model->getSkillArray($skills_id);
            foreach($skills as $skill_entries) {
                $skill = new Skill($skill_entries);
                array_push($skills_array, $skill);
            }

            return $skills_array;
        }

        public function getInventory($sheet_id) {
            $inventory_entries = $this->model->getInventory($sheet_id);

            $items_array = $this->getItemsArray($inventory_entries['inventory_id']);

            $inventory_entries['items'] = $items_array;
            $inventory = new Inventory($inventory_entries);

            return $inventory;
        }

        public function getItemsArray($inventory_id) {
            $items = $this->model->getItemsArray($inventory_id);

            $items_array = array();
            foreach($items as $item_entries) {
                $item = new Item($item_entries, $item_entries['item_id']);
                array_push($items_array, $item);
            }

            return $items_array;
        }

        public function getLanguages($sheet_id) {
            $languages_entries = $this->model->getLanguages($sheet_id);

            $languages_array = $this->getLanguageArray($languages_entries['languages_id']);
            $languages_entries['languages'] = $languages_array;

            $languages = new Languages($languages_entries);
            return $languages;
        }

        public function getLanguageArray($languages_id) {
            $languages_array = $this->model->getLanguageArray($languages_id);
            return $languages_array;
        }

        public function getArmors($sheet_id) {
            $armors_id = $this->model->getArmors($sheet_id);
            $armor = $this->getArmor($armors_id);
            $shield = $this->getShield($armors_id);
            $protective_items = $this->getProtectiveItems($armors_id);

            $armors_segments = array(
                'armor' => $armor,
                'shield' => $shield,
                'protective_items' => $protective_items
            );

            $armors = new Armors($armors_segments);

            return $armors;
        }

        public function getArmor($armors_id) {
            $armor_entries = $this->model->getArmor($armors_id);
            $armor = new Armor($armor_entries);
            return $armor;
        }

        public function getShield($armors_id) {
            $shield_entries = $this->model->getShield($armors_id);
            $shield = new Shield($shield_entries);
            return $shield;
        }

        public function getProtectiveItems($armors_id) {
            $protective_items_data = $this->model->getProtectiveItems($armors_id);

            $protective_items = array();

            foreach($protective_items_data as $protective_item_entries) {
                $protective_item_id  =$protective_item_entries['protective_item_id'];
                $protective_item = new Protective_Item($protective_item_entries, $protective_item_id);
                array_push($protective_items, $protective_item);
            }

            return $protective_items;
        }

        public function getAttributes($sheet_id) {
            $attributes_array = $this->model->getAttributes($sheet_id);

            $attributes = array();
            foreach($attributes_array as $attributes_entries) {
                $attribute = new Attribute($attributes_entries);
                array_push($attributes, $attribute);
            }

            return $attributes;
        }

        public function getSavingThrows($sheet_id) {
            $saving_throws_array = $this->model->getSavingThrows($sheet_id);

            $saving_throws = array();
            foreach($saving_throws_array as $saving_throw_entries) {
                $saving_throw = new Saving_Throw($saving_throw_entries);
                array_push($saving_throws, $saving_throw);
            }

            return $saving_throws;

        }

        public function getFeats($sheet_id) {
            $feats_array = $this->model->getFeats($sheet_id);

            $feats = array();
            foreach($feats_array as $feats_entries) {
                $feat = new Feat($feats_entries);
                array_push($feats, $feat);
            }

            return $feats;
        }

        public function getSpecialAbilities($sheet_id) {
            $special_abilities_array = $this->model->getSpecialAbilities($sheet_id);

            $special_abilities = array();
            foreach($special_abilities_array as $special_abilities_entries) {
                $special_ability = new Special_Ability($special_abilities_entries);
                array_push($special_abilities, $special_ability);
            }

            return $special_abilities;
        }

        public function getCurrencies($sheet_id) {
            $currencies_array = $this->model->getCurrencies($sheet_id);

            $currencies = array();
            foreach($currencies_array as $currencies_entries) {
                $currency = new Currency($currencies_entries);
                array_push($currencies, $currency);
            }

            return $currencies;
        }

    }

}