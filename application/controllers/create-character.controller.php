<?php
/**
 * A controller class file for the create-character page
 */

if(!class_exists('Create_Character_Controller')) {

    class Create_Character_Controller extends Base_Controller {

        public function __construct(Create_Character_Model $model) {
            $this->model = $model;
            parent::__construct($model);
        }

        /**
         * A method to create the Character_Sheet instance for the given character.
         * Calls a create-method for each of the character sheets segments:
         * Personalia, Stats, Attacks, Attributes, Skills and Purse
         * and creates a class instantiation each segment respectively and gathers them in the $segments array,
         * which is used as the parameter for the Character_Sheet instantiation.
         */
        public function createCharacter() {

            $personalia = $this->createPersonalia();
            $stats = $this->createStats();
            $attacks = $this->createAttacks();
            $attributes = $this->createAttributes();
            $skills = $this->createSkills();
            $purse = $this->createPurse();
            $languages = $this->createLanguages();
            $special_abilities = $this->createSpecialAbilities();
            $feats = $this->createFeats();
            $inventory = $this->createInventory();
            $saving_throws = $this->createSavingThrows();
            $armors = $this->createArmors();

            $segments = array (
                'personalia' => $personalia,
                'stats' => $stats,
                'attacks' => $attacks,
                'attributes' => $attributes,
                'skills' => $skills,
                'purse' => $purse,
                'languages' => $languages,
                'special_abilities' => $special_abilities,
                'feats' => $feats,
                'inventory' => $inventory,
                'saving_throws' => $saving_throws,
                'armors' => $armors
            );

            $sheet = new Character_Sheet($segments);
            var_dump($armors);
            //$this->model->addCharacter($_SESSION['user_id'], $sheet);
        }

        /**
         * Creates an associative array to hold the Personalia variables called $personalia_entries,
         * which is used as only parameter for the Personalia class instantiation
         * @return Personalia - a class representation of the Character_Sheet personalia segment
         */
        public function createPersonalia() {

            $personalia_entries = array (
                'name' => $_POST['name'],
                'class' => $_POST['class'],
                'level' => $_POST['level'],
                'size' => $_POST['size'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender'],
                'height' => $_POST['height'],
                'weight' => $_POST['weight'],
                'eyes' => $_POST['eyes'],
                'hair' => $_POST['hair'],
                'skin' => $_POST['skin'],
                'race' => $_POST['race'],
                'alignment' => $_POST['alignment'],
                'deity' => $_POST['deity'],
                'xp' => $_POST['xp'],
                'next_level' => $_POST['next_level']
            );

            $personalia = new Personalia($personalia_entries);
            
            return $personalia;

        }

        /**
         * Creates an associative array to hold the Stats variables called $stats_entries,
         * which is used as only parameter for the Stats class instantiation.
         * The Stats segment includes a sub-segment called Armor_Class which is its own
         * class representation and is created by the call to the createArmorClass method.
         * @return Stats - a class representation of the Character_Sheet stats segment
         */
        public function createStats() {
            
            $armor_class = $this->createArmorClass();

            $stats_entries = array (
                'hp' => $_POST['hp'],
                'wounds' => $_POST['wounds'],
                'non_lethal' => $_POST['non_lethal'],
                'armor_class' => $armor_class,
                'touch_ac' => $_POST['touch_ac'],
                'flat_footed' => $_POST['flat_footed'],
                'initiative_mod' => $_POST['initiative_mod'],
                'spell_resistance' => $_POST['spell_resistance'],
                'speed' => $_POST['speed'],
                'damage_reduction' => $_POST['damage_reduction']
            );

            $stats = new Stats($stats_entries);
            
            return $stats;
        }

        /**
         * Creates an associative array to hold the Armor_Class variables called $armor_class_entries,
         * which is used as the only parameter for the Armor_Class class instantiation.
         * @return Armor_Class - a class representation of the Stats class' Armor_Class sub-segment.
         */
        public function createArmorClass() {
            
            $armor_class_entries = array (
                'ac_total' => $_POST['ac_total'],
                'ac_base' => $_POST['ac_base'],
                'ac_armor_bonus' => $_POST['ac_armor_bonus'],
                'ac_shield_bonus' => $_POST['ac_shield_bonus'],
                'ac_dex_mod' => $_POST['ac_dex_mod'],
                'ac_size_mod' => $_POST['ac_size_mod'],
                'ac_natural_armor' => $_POST['ac_natural_armor']
            );

            $armor_class = new Armor_Class($armor_class_entries);
            
            return $armor_class;
        }

        /**
         * Creates an associative array to hold the Grappe variables called $grapple_entries,
         * which is used as the only parameter for the Grapple class instantiation.
         * @return Grapple - a class representation of the Attacks class' Grapple sub-segment.
         */
        public function createGrapple() {
            $grapple_entries = array (
                'grapple_total' => $_POST['grapple_total'],
                'grapple_bab' => $_POST['grapple_bab'],
                'grapple_str_mod' => $_POST['grapple_str_mod'],
                'grapple_size_mod' => $_POST['grapple_size_mod'],
                'grapple_misc_mod' => $_POST['grapple_misc_mod']
            );

            $grapple = new Grapple($grapple_entries);

            return $grapple;
        }

        /**
         * Creates an associative array to hold the Grappe variables called $grapple_entries,
         * which is used as the only parameter for the Grapple class instantiation.
         * @return Grapple - a class representation of the Attacks class' Grapple sub-segment.
         */
        /**
         * Creates an associative array to hold the Attacks variables called $attacks_entries,
         * which is used as only parameter for the Attacks class instantiation.
         * The Attacks segment includes the sub-segments called Grapple which is its own
         * class representation and is created by the call to the createGrapple method.
         * @return Attacks - a class representation of the Character_Sheet Attacks segment
         */
        public function createAttacks() {
            $grapple = $this->createGrapple();
            $attacks_array = $this->createAttacksArray();

            $attacks_entries = array (
                'base_attack_bonus' => $_POST['base_attack_bonus'],
                'attacks_per_round' => $_POST['attacks_per_round'],
                'grapple' => $grapple,
                'attacks_array' => $attacks_array
            );

            $attacks = new Attacks($attacks_entries);

            return $attacks;
        }

        /**
         * A method to create a given number of attacks which is
         * then pushed into the $attack array
         * @return array - an array of Attack entries
         */
        public function createAttacksArray() {
            $no_atts = 4;
            $attacks_array = array();
            for ($i = 0; $i < $no_atts; $i++) {
                $attack = $this->createAttack($i);
                array_push($attacks_array, $attack);
            }

            return $attacks_array;
        }

        /**
         * A function to create an instance of the Attack class with the appropriate variables
         * from the $_POST-array
         * @param $n - the index of the Attack
         * @return Attack - an instance of the Attack class
         */
        public function createAttack($n) {
            $attack_entries = array (
                'attack_name' => $_POST['attack_name_' . $n],
                'attack_bonus' => $_POST['attack_bonus_' . $n],
                'attack_damage' => $_POST['attack_damage_' . $n],
                'critical_floor' => $_POST['critical_floor_' . $n],
                'critical_ceiling' => $_POST['critical_ceiling_' . $n],
                'weapon_range' => $_POST['weapon_range_' . $n],
                'attack_type' => $_POST['attack_type_' . $n],
                'attack_notes' => $_POST['attack_notes_' . $n],
                'ammunition' => $_POST['ammunition_' . $n]
            );
            
            $attack = new Attack($attack_entries);
            
            return $attack;
        }

        /**
    * Creates an associative array to hold the Grappe variables called $grapple_entries,
    * which is used as the only parameter for the Grapple class instantiation.
    * @return Grapple - a class representation of the Attacks class' Grapple sub-segment.
         */
        /**
         * A method to create an associative array for each of the attributes (strength,
         * constitution, dexterity, intelligence, wisdom, charisma) which is in turn
         * used to create an instance of the Attribute class.
         * @return array - an array of Attributes instantiations
         */
        public function createAttributes() {
            
            $strength_attr_entries = array (
                'name' => 'strength',
                'ability_score' => $_POST['strength_score'],
                'ability_mod' => $_POST['strength_mod'],
                'temp_score' => $_POST['strength_temp_score'],
                'temp_mod' => $_POST['strength_temp_mod']
            );

            $strength_attr = new Attribute($strength_attr_entries);

            $constitution_attr_entries = array (
                'name' => 'constitution',
                'ability_score' => $_POST['constitution_score'],
                'ability_mod' => $_POST['constitution_mod'],
                'temp_score' => $_POST['constitution_temp_score'],
                'temp_mod' => $_POST['constitution_temp_mod']
            );

            $constitution_attr = new Attribute($constitution_attr_entries);

            $dexterity_attr_entries = array (
                'name' => 'dexterity',
                'ability_score' => $_POST['dexterity_score'],
                'ability_mod' => $_POST['dexterity_mod'],
                'temp_score' => $_POST['dexterity_temp_score'],
                'temp_mod' => $_POST['dexterity_temp_mod']
            );

            $dexterity_attr = new Attribute($dexterity_attr_entries);

            $intelligence_attr_entries = array (
                'name' => 'intelligence',
                'ability_score' => $_POST['intelligence_score'],
                'ability_mod' => $_POST['intelligence_mod'],
                'temp_score' => $_POST['intelligence_temp_score'],
                'temp_mod' => $_POST['intelligence_temp_mod']
            );

            $intelligence_attr = new Attribute($intelligence_attr_entries);

            $wisdom_attr_entries = array (
                'name' => 'wisdom',
                'ability_score' => $_POST['wisdom_score'],
                'ability_mod' => $_POST['wisdom_mod'],
                'temp_score' => $_POST['wisdom_temp_score'],
                'temp_mod' => $_POST['wisdom_temp_mod']
            );

            $wisdom_attr = new Attribute($wisdom_attr_entries);

            $charisma_attr_entries = array (
                'name' => 'charisma',
                'ability_score' => $_POST['charisma_score'],
                'ability_mod' => $_POST['charisma_mod'],
                'temp_score' => $_POST['charisma_temp_score'],
                'temp_mod' => $_POST['charisma_temp_mod']
            );

            $charisma_attr = new Attribute($charisma_attr_entries);

            $attributes = array (
                'strength' => $strength_attr,
                'constitution' => $constitution_attr,
                'dexterity' => $dexterity_attr,
                'intelligence' => $intelligence_attr,
                'wisdom' => $wisdom_attr,
                'charisma' => $charisma_attr
            );
            
            return $attributes;
        }

        /**
         * A method to create Skill_Template database mockup,
         * builds Skill_Templates and adds it to a non-associative array
         * @return array - an array of Skill_Templates
         */
        public function createSkillsMockup() {
            //templates mock-up
            $sleight_of_hand = new Skill_Template('sleight_of_hand', 'Sleight Of Hand', 'dex', 'sleight of hand description here ...');
            $pick_lock = new Skill_Template('pick_lock', 'Pick Lock', 'dex', 'pick lock description here ...');
            $ride_horse = new Skill_Template('ride_horse', 'Ride Horse', 'dex', 'ride horse description here ...');

            $templates_array = array ($sleight_of_hand, $pick_lock, $ride_horse);

            return $templates_array;
        }

        /**
         * A method to create an instance of the Skill class for each Skill_Template found
         * in the $templates_array from the createSkillsMockup method, and then creates an
         * instance of the Skills class as a segment for the Character_Sheet
         * @return Skills - an instance of the Skills class
         */
        public function createSkills() {
            $templates_array = $this->createSkillsMockup();

            $skill_array = array();
            foreach($templates_array as $template) {
                $template_name = $template->getTemplateName();
                $skill_entries = array(
                    'template_name' => $template_name,
                    'skill_mod' => $_POST['skill_' . $template_name . '_skill_mod'],
                    'ability_mod' => $_POST['skill_' . $template_name . '_ability_mod'],
                    'ranks' => $_POST['skill_' . $template_name . '_ranks'],
                    'misc_mod' => $_POST['skill_' . $template_name . '_misc_mod']
                );

                $skill = new Skill($skill_entries);
                array_push($skill_array, $skill);
            }

            $skills_entries = array (
                'max_ranks_class' => $_POST['max_ranks_class'],
                'max_ranks_cross_class' => $_POST['max_ranks_cross_class'],
                'skill_array' => $skill_array
            );

            $skills = new Skills($skills_entries);

            return $skills;
        }

        /**
         * A method that builds an associative array called $purse_entries,
         * which is used as the only parameter for the instantiation of the Purse class
         * @return purse - A class instance of the Purse segment
         */
        public function createPurse() {
            $purse_entries = array(
                'gold' => $_POST['gold'],
                'silver' => $_POST['silver'],
                'copper' => $_POST['copper']
            );

            $purse = new Purse($purse_entries);

            return $purse;
        }

        /**
         * A method to create an array of languages from the post array
         * @return array - an array of Language
         */
        public function createLanguages() {
            $base_languages = 6;

            $languages = array();
            for ($x = 0; $x < $base_languages; $x++) {
                $language = $_POST['language' . $x];
                array_push($languages, $language);
            }

            $languages_entries = array(
                'max_no_of_languages' => $_POST['max_no_of_languages'],
                'languages' => $languages
            );

            $languages = new Languages($languages_entries);

            return $languages;
        }

        /**
         * A method to create an array of names of special abilities which is then used as the only
         * parameter to construct an instance of the class Special_Abilities.
         * The number of names of special abilities generated is dictated by the constant
         * NO_OF_SPECIAL_ABILITES set in config.php
         * @return Special_Abilities - an instance of the Special_Abilities class
         * representing the special abilities segment of the Character Sheet
         */
        public function createSpecialAbilities() {
            $special_abilities_array = array();

            for($x = 0; $x < NO_OF_SPECIAL_ABILITIES; $x++) {
                $special_ability = $_POST['special_ability' . $x];
                array_push($special_abilities_array, $special_ability);
            }

            $special_abilities_entries = array(
                'special_abilities_array' => $special_abilities_array
            );
            $special_abilities = new Special_Abilities($special_abilities_entries);

            return $special_abilities;
        }

        /**
         * A method to create an array of names of feats which is then used as the only
         * parameter to construct an instance of the class Feats.
         * The number of names of feats generated is dictated by the constant
         * NO_OF_FEATS set in config.php
         * @return Feats - an instance of the Feats class representing the feats segment of the Character Sheet
         */
        public function createFeats() {
            $feats_array = array();

            for($x = 0; $x < NO_OF_FEATS; $x++) {
                $feat = $_POST['feat' . $x];
                array_push($feats_array, $feat);
            }

            $feats_entries = array(
                'feats_array' => $feats_array
            );

            $feats = new Feats($feats_entries);

            return $feats;
        }

        /**
         * A method to create an $items_array of Item from post array where the number of items generated is
         * dictated by the NO_OF_INVENTORY_ITEMS set in config.php.
         * The method then creates an $inventory_entries array which holds the Inventory variables
         * @return Inventory - an instance of the Inventory class representing the inventory
         * segment of the Character Sheet
         */
        public function createInventory() {
            $items_array = array();
            
            for($x = 0; $x < NO_OF_INVENTORY_ITEMS; $x++) {
                $items_entries = array(
                    'name' => $_POST['item_name' . $x],
                    'weight' => $_POST['item_weight' . $x],
                    'quantity' => $_POST['item_quantity' . $x]
                );

                $item = new Item($items_entries);
                array_push($items_array, $item);
            }

            $inventory_entries = array(
                'light_load' => $_POST['light_load'],
                'medium_load' => $_POST['medium_load'],
                'heavy_load' => $_POST['heavy_load'],
                'lift_over_head' => $_POST['lift_over_head'],
                'lift_off_ground' => $_POST['lift_off_ground'],
                'push_or_drag' => $_POST['push_or_drag'],
                'items' => $items_array
            );

            $inventory = new Inventory($inventory_entries);

            return $inventory;
        }

        public function createSavingThrows() {
            $categories = array(
                'fortitude' => 'constitution',
                'reflex' => 'dexterity',
                'will' => 'wisdom'
            );

            $saving_throw_array = array();
            foreach($categories as $key => $value) {
                $saving_throw_entries = array(
                    'name' => $key,
                    'key_ability' => $value,
                    'total' => $_POST['saving_throw_' . $key . '_total'],
                    'base_save' => $_POST['saving_throw_' . $key . '_base_save'],
                    'ability_modifier' => $_POST['saving_throw_' . $key . '_ability_modifier'],
                    'magic_modifier' => $_POST['saving_throw_' . $key . '_magic_modifier'],
                    'misc_modifier' => $_POST['saving_throw_' . $key . '_misc_modifier'],
                    'temp_modifier' => $_POST['saving_throw_' . $key . '_temp_modifier'],
                );

                $saving_throw = new Saving_Throw($saving_throw_entries);
                array_push($saving_throw_array, $saving_throw);
            }

            $saving_throws = new Saving_Throws($saving_throw_array);

            return $saving_throws;
        }

        //TODO create comment
        public function createArmors() {
            $armor = $this->createArmor();
            $shield = $this->createShield();
            $protective_items = $this->createProtectiveItems();

            $armors_entries = array(
                'armor' => $armor,
                'shield' => $shield,
                'protective_items' => $protective_items
            );

            $armors = new Armors($armors_entries);

            return $armors;
        }

        //TODO create comment
        public function createArmor() {
            $armor_entries = array(
                'armor_name' => $_POST['armor_name'],
                'armor_type' => $_POST['armor_type'],
                'armor_ac_bonus' => $_POST['armor_ac_bonus'],
                'armor_max_dex' => $_POST['armor_max_dex'],
                'armor_check_penalty' => $_POST['armor_check_penalty'],
                'armor_spell_failure' => $_POST['armor_spell_failure'],
                'armor_speed' => $_POST['armor_speed'],
                'armor_weight' => $_POST['armor_weight'],
                'armor_special_properties' => $_POST['armor_special_properties'],
            );

            $armor = new Armor($armor_entries);

            return $armor;
        }

        //TODO create comment
        public function createShield() {
            $shield_entries = array(
                'shield_name' => $_POST['shield_name'],
                'shield_ac_bonus' => $_POST['shield_ac_bonus'],
                'shield_weight' => $_POST['shield_weight'],
                'shield_check_penalty' => $_POST['shield_check_penalty'],
                'shield_spell_failure' => $_POST['shield_spell_failure'],
                'shield_special_properties' => $_POST['shield_special_properties']
            );

            $shield = new shield($shield_entries);

            return $shield;
        }

        //TODO create comment
        public function createProtectiveItems() {
            $protective_item_entries = array(
                'protective_item_name' => $_POST['protective_item_name'],
                'protective_item_ac_bonus' => $_POST['protective_item_ac_bonus'],
                'protective_item_weight' => $_POST['protective_item_weight'],
                'protective_item_special_properties' => $_POST['protective_item_special_properties']
            );

            $protective_item = new shield($protective_item_entries);

            return $protective_item;
        }

    }

}