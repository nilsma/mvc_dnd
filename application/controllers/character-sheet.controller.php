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
        
        public function updatePersonalia($sheet_id, $segments) {
            $personalia = new Personalia($segments);
            $this->model->writePersonalia($sheet_id, $personalia);
        }

        public function updateStats($sheet_id, $segments) {
            $stats = new Stats($segments);
            $this->model->writeStats($sheet_id, $stats);
        }

        public function updateArmorClass($sheet_id, $segments) {
            $armor_class = new Armor_Class($segments);
            $this->model->writeArmorClass($sheet_id, $armor_class);
        }

        public function updateAttribute($sheet_id, $segments, $attribute_label) {
            $attribute = new Attribute($segments);
            $this->model->writeAttribute($sheet_id, $attribute, $attribute_label);
        }

        public function updateSavingThrow($sheet_id, $segments, $saving_throw_label) {
            $saving_throw = new Saving_Throw($segments);
            $this->model->writeSavingThrow($sheet_id, $saving_throw, $saving_throw_label);
        }

        public function updateAttacks($sheet_id, $segments) {
            $this->model->writeAttacks($sheet_id, $segments);
        }

        public function updateAttack($sheet_id, $segments) {
            $attack = new Attack($segments, $segments['id']);
            $this->model->writeAttack($sheet_id, $attack);
        }

        public function updateGrapple($sheet_id, $segments) {
            $grapple = new Grapple($segments);
            $this->model->writeGrapple($sheet_id, $grapple);
        }

        public function addSpecialAbility($sheet_id, $template_name) {
            $this->model->insertSpecialAbility($sheet_id, $template_name);
        }

        public function removeLanguage($sheet_id, $language) {
            $this->model->deleteLanguage($sheet_id, $language);
        }

        public function removeItem($sheet_id, $item) {
            $this->model->deleteItem($sheet_id, $item);
        }

        public function removeSpecialAbility($sheet_id, $template_name) {
            $this->model->deleteSpecialAbility($sheet_id, $template_name);
        }

        public function addFeat($sheet_id, $template_name) {
            $this->model->insertFeat($sheet_id, $template_name);
            //$_SESSION['character_variables'] = $_POST; //todo
        }

        public function removeFeat($sheet_id, $template_name) {
            $this->model->deleteFeat($sheet_id, $template_name);
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

        public function removeProtectiveItem($sheet_id, $protective_item_id) {
            $this->model->deleteProtectiveItem($sheet_id, $protective_item_id);
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

        public function removeCurrency($sheet_id, $currency_name) {
            $this->model->deleteCurrency($sheet_id, $currency_name);
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

        public function removeAttack($sheet_id, $attack_id) {
            $this->model->deleteAttack($sheet_id, $attack_id);
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