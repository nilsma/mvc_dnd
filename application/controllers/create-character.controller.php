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

        public function addItem() {
            $no_of_inventory_items = $_SESSION['no_of_inventory_items'];
            $no_of_inventory_items++;
            $_SESSION['no_of_inventory_items'] = $no_of_inventory_items;
            $_SESSION['creation_array'] = $_POST;
        }

        public function removeItem() {
            $no_of_inventory_items = $_SESSION['no_of_inventory_items'];
            $no_of_inventory_items--;
            $_SESSION['no_of_inventory_items'] = $no_of_inventory_items;
            $_SESSION['creation_array'] = $_POST;
        }

        public function addFeat($template_name, $common_name) {
            $feats_array = $_SESSION['feats_array'];
            $feats_array[$template_name] = $common_name;
            $_SESSION['feats_array'] = $feats_array;
            $_SESSION['creation_array'] = $_POST;
        }

        public function addSpecialAbility($template_name, $common_name) {
            $special_abilities_array = $_SESSION['special_abilities_array'];
            $special_abilities_array[$template_name] = $common_name;
            $_SESSION['special_abilities_array'] = $special_abilities_array;
            $_SESSION['creation_array'] = $_POST;
        }

        public function removeLanguage($language) {
            $languages = $_SESSION['languages_array'];
            $index = array_search($language, $languages);
            unset($languages[$index]);
            $_SESSION['languages_array'] = $languages;
            $_SESSION['creation_array'] = $_POST;
        }

        public function addLanguage($language) {
            $languages = $_SESSION['languages_array'];

            if(!in_array($language, $languages)) {
                array_push($languages, $language);
            }

            $_SESSION['languages_array'] = $languages;
            $_SESSION['creation_array'] = $_POST;
        }

        public function removeCurrency($currency) {
            $currencies = $_SESSION['currencies_array'];
            $currency = strtolower($currency);
            $counter = 0;

            foreach($currencies as $inner) {
                if(in_array($currency, $inner, TRUE)) {
                    $index = $counter;
                }
                $counter++;
            }

            if(isset($index)) {
                unset($currencies[$index]);
            }

            $reindex_currencies = array_values($currencies);

            $_SESSION['currencies_array'] = $reindex_currencies;
        }

        public function addCurrency($new_currency) {
            $label = 'currency_' . $new_currency;
            $name = $new_currency;
            $amount = 0;

            $currency = array('label' => $label, 'name' => $name, 'amount' => $amount);
            $currencies = $_SESSION['currencies_array'];
            array_push($currencies, $currency);
            $_SESSION['currencies_array'] = $currencies;
            $_SESSION['creation_array'] = $_POST;
        }

        public function removeProtectiveItem() {
            $_SESSION['no_of_protective_items'] -= 1;
            $_SESSION['creation_array'] = $_POST;
        }

        public function addProtectiveItem() {
            $_SESSION['no_of_protective_items'] += 1;
            $_SESSION['creation_array'] = $_POST;
        }

        public function removeAttack() {
            $_SESSION['no_of_attacks'] -= 1;
            $_SESSION['creation_array'] = $_POST;
        }

        public function addAttack() {
            $_SESSION['no_of_attacks'] += 1;
            $_SESSION['creation_array'] = $_POST;
        }

        /**
         * A method that creates an instance, or an array-representation, of the various character sheet segments
         * and subsequently puts the segments in its own array which is then used as a paramenter for the
         * addCharacter method to add the character segments to the database.
         * The class instances and the array-representations are differentiated by the denotation of the method
         * where the array-representation methods ends in 'Array'.
         */
        public function createCharacter($user_id) {

            $character_segments = array (
                'personalia' => $this->createPersonalia(),
                'stats' => $this->createStats(),
                'attacks' => $this->createAttacks(),
                'attributes' => $this->createAttributesArray(),
                'skills' => $this->createSkills(),
                'languages' => $this->createLanguages(),
                'inventory' => $this->createInventory(),
                'purse' => $this->createPurseArray(),
                'special_abilities' => $this->createSpecialAbilitiesArray(),
                'feats' => $this->createFeatsArray(),
                'saving_throws' => $this->createSavingThrowsArray(),
                'armors' => $this->createArmors(),
                'armor_class' => $this->createArmorClass(),
                'grapple' => $this->createGrapple()
            );

            $character_sheet_id = $this->model->addCharacter($user_id, $character_segments);
            return $character_sheet_id;
        }

        /**
         * a function to remove, or unload, an already selected special ability from the session array called
         * special_abilities_array based on the special ability's common_name
         * @param $common_name - the common_name of the special ability to unselect
         */
        public function unloadSpecialAbility($common_name) {
            $special_abilities = array();

            if(isset($_SESSION['special_abilities_array'])) {
                $special_abilities = $_SESSION['special_abilities_array'];
            }

            $index = array_search($common_name, $special_abilities);
            if($index !== FALSE) {
                unset($special_abilities[$index]);
            }

            $_SESSION['special_abilities_array'] = $special_abilities;
        }

        public function unloadFeat($common_name) {
            $feats = array();

            if(isset($_SESSION['feats_array'])) {
                $feats = $_SESSION['feats_array'];
            }

            $index = array_search($common_name, $feats);
            if($index !== FALSE) {
                unset($feats[$index]);
            }

            $_SESSION['feats_array'] = $feats;
        }

        /**
         * a function to store, or load, the given special ability to the session array
         * called special_abilities_array, based on the special ability's template_name
         * @param $template_name - a string representation of the special ability
         */
        public function loadSpecialAbility($template_name) {
            $special_abilities = array();

            if(isset($_SESSION['special_abilities_array'])) {
                $special_abilities = $_SESSION['special_abilities_array'];
            }

            $common_name = $this->model->getSpecialAbilityCommonName($template_name);
            $special_abilities[$template_name] = ucwords($common_name);

            $_SESSION['special_abilities_array'] = $special_abilities;
        }

        public function loadFeat($template_name) {
            $feats = array();

            if(isset($_SESSION['feats_array'])) {
                $feats = $_SESSION['feats_array'];
            }

            $common_name = $this->model->getFeatCommonName($template_name);
            $feats[$template_name] = ucwords($common_name);

            $_SESSION['feats_array'] = $feats;
        }

        /**
         * Creates an associative array to hold the Personalia variables called $personalia_entries,
         * which is used as only parameter for the Personalia class instantiation
         * @return Personalia - a class representation of the Character_Sheet personalia segment
         */
        public function createPersonalia() {

            $personalia_entries = array (
                'name' => $_POST['personalia_name'],
                'class' => $_POST['personalia_class'],
                'level' => $_POST['personalia_level'],
                'size' => $_POST['personalia_size'],
                'age' => $_POST['personalia_age'],
                'gender' => $_POST['personalia_gender'],
                'height' => $_POST['personalia_height'],
                'weight' => $_POST['personalia_weight'],
                'eyes' => $_POST['personalia_eyes'],
                'hair' => $_POST['personalia_hair'],
                'skin' => $_POST['personalia_skin'],
                'race' => $_POST['personalia_race'],
                'alignment' => $_POST['personalia_alignment'],
                'deity' => $_POST['personalia_deity'],
                'xp' => $_POST['personalia_xp'],
                'next_level' => $_POST['personalia_next_level']
            );

            $washed = Utils::washArray($personalia_entries);
            $personalia = new Personalia($washed);
            
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

            $stats_entries = array (
                'stats_hp' => $_POST['stats_hp'],
                'stats_wounds' => $_POST['stats_wounds'],
                'stats_non_lethal' => $_POST['stats_non_lethal'],
                'stats_initiative_mod' => $_POST['stats_initiative_mod'],
                'stats_spell_resistance' => $_POST['stats_spell_resistance'],
                'stats_speed' => $_POST['stats_speed'],
                'stats_damage_reduction' => $_POST['stats_damage_reduction']
            );

            $washed = Utils::washArray($stats_entries);
            $stats = new Stats($washed);

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
                'ac_natural_armor' => $_POST['ac_natural_armor'],
                'ac_touch_ac' => $_POST['ac_touch_ac'],
                'ac_flat_footed_ac' => $_POST['ac_flat_footed_ac']
            );

            $washed = Utils::washArray($armor_class_entries);
            $armor_class = new Armor_Class($washed);
            
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
                'grapple_bab' => $_POST['grapple_base_attack_bonus'],
                'grapple_str_mod' => $_POST['grapple_str_mod'],
                'grapple_size_mod' => $_POST['grapple_size_mod'],
                'grapple_misc_mod' => $_POST['grapple_misc_mod']
            );

            $washed = Utils::washArray($grapple_entries);
            $grapple = new Grapple($washed);

            return $grapple;
        }

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
                'base_attack_bonus' => $_POST['attacks_base_attack_bonus'],
                'attacks_per_round' => $_POST['attacks_attacks_per_round']
            );

            $washed = Utils::washArray($attacks_entries);
            $washed['attacks_array'] = $attacks_array;
            $attacks = new Attacks($washed);

            return $attacks;
        }

        /**
         * A method to create a given number of attacks which is
         * then pushed into the $attack array
         * @return array - an array of Attack entries
         */
        public function createAttacksArray() {
            $no_atts = $_SESSION['no_of_attacks'];
            $attacks_array = array();
            for ($i = 1; $i < $no_atts + 1; $i++) {
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
                'attack_bonus' => $_POST['attack_attack_bonus_' . $n],
                'attack_damage' => $_POST['attack_damage_' . $n],
                'critical_floor' => $_POST['attack_critical_floor_' . $n],
                'critical_ceiling' => $_POST['attack_critical_ceiling_' . $n],
                'weapon_range' => $_POST['attack_weapon_range_' . $n],
                'attack_type' => $_POST['attack_type_' . $n],
                'attack_notes' => $_POST['attack_notes_' . $n],
                'ammunition' => $_POST['attack_ammunition_' . $n]
            );

            $washed = Utils::washArray($attack_entries);
            $attack = new Attack($washed);

            return $attack;
        }

        /**
         * A method to create an associative array for each of the attributes (strength,
         * constitution, dexterity, intelligence, wisdom, charisma) which is in turn
         * used to create an instance of the Attribute class.
         * @return array - an array of Attributes instantiations
         */
        public function createAttributesArray() {
            $attributes = array();

            $categories = array(
                'strength', 'constitution', 'dexterity',
                'intelligence', 'wisdom', 'charisma'
            );

            foreach($categories as $category) {
                $attribute_entries = array (
                    'name' => $category,
                    'ability_score' => $_POST[$category . '_score'],
                    'ability_mod' => $_POST[$category . '_mod'],
                    'temp_score' => $_POST[$category . '_temp_score'],
                    'temp_mod' => $_POST[$category . '_temp_mod']
                );

                $washed = Utils::washArray($attribute_entries);
                $attribute = new Attribute($washed);
                $attributes[$category] = $attribute;

            }
            
            return $attributes;
        }

        /**
         * A method to create an instance of the Skill class for each Skill_Template found
         * in the $templates_array from the getSkillsTemplates method, and then creates an
         * instance of the Skills class as a segment for the Character_Sheet
         * @return Skills - an instance of the Skills class
         */
        public function createSkills() {
            $templates_array = $this->model->getSkillsTemplates();
            $skill_array = array();

            foreach($templates_array as $template) {
                $template_name = $template['template_name'];
                $skill_entries = array(
                    'template_name' => $template_name,
                    'skill_mod' => $_POST['skill_' . $template_name . '_skill_mod'],
                    'ability_mod' => $_POST['skill_' . $template_name . '_ability_mod'],
                    'ranks' => $_POST['skill_' . $template_name . '_ranks'],
                    'misc_mod' => $_POST['skill_' . $template_name . '_misc_mod']
                );

                $washed_skill = Utils::washArray($skill_entries);
                $skill = new Skill($washed_skill);
                array_push($skill_array, $skill);
            }

            $skills_entries = array (
                'max_ranks_class' => $_POST['skills_max_ranks_class'],
                'max_ranks_cross_class' => $_POST['skills_max_ranks_cross_class']
            );

            $washed_skills = Utils::washArray($skills_entries);
            $washed_skills['skill_array'] = $skill_array;
            $skills = new Skills($washed_skills);

            return $skills;
        }

        /**
         * A method that builds an associative array called $purse_entries,
         * which is used as the only parameter for the instantiation of the Purse class
         * @return purse - A class instance of the Purse segment
         */
        public function createPurseArray() {
            $purse = array();
            $currencies = $_SESSION['currencies_array'];

            foreach($currencies as $currency) {
                $label = $currency['label'];
                $name = $currency['name'];
                $amount = $_POST[$label];

                $currency_entries = array('label' => $label, 'name' => $name, 'amount' => $amount);
                $currency_entries = Utils::washArray($currency_entries);

                $new_currency = New Currency($currency_entries);
                $purse[] = $new_currency;
            }

            return $purse;
        }

        public function getBaseCurrencies() {
            $base_currencies = array();
            $categories = array('gold', 'silver', 'copper');

            foreach($categories as $category) {
                $currency = array(
                    'label' => $category,
                    'name' => ucfirst($category),
                    'amount' => 0
                );

                array_push($base_currencies, $currency);
            }

            return $base_currencies;
        }

        /**
         * A method to create an array of languages from the post array
         * @return array - an array of Language
         */
        public function createLanguages() {
            $languages = $_SESSION['languages_array'];

            $languages_entries = array(
                'max_number_of_languages' => $_POST['max_number_of_languages']
            );

            $washed = Utils::washArray($languages_entries);
            $washed['languages'] = $languages;
            $languages = new Languages($washed);

            return $languages;
        }

        /**
         * a method to create an instance of the class Special_Ability for each of the chosen special ability
         * in the session registered array special_abilities_array
         * @return $special_abilities - an array of instances of the class Special_Ability
         */
        public function createSpecialAbilitiesArray() {
            $special_abilities = array();
            $special_abilities_session_array = array();

            if(isset($_SESSION['special_abilities_array'])) {
                $special_abilities_session_array = $_SESSION['special_abilities_array'];
            }

            foreach($special_abilities_session_array as $key => $val) {
                $special_ability = new Special_Ability(Utils::html($key));
                array_push($special_abilities, $special_ability);
            }

            return $special_abilities;
        }

        /**
         * a method to create an instance of the class Feat for each of the chosen feat in the session registered
         * array feats_array
         * @return $feats - an array of instances of the class Feat
         */
        public function createFeatsArray() {
            $feats = array();
            $feats_session_array = array();

            if(isset($_SESSION['feats_array'])) {
                $feats_session_array = $_SESSION['feats_array'];
            }

            foreach($feats_session_array as $key => $val) {
                $feat = new Feat(Utils::html($key));
                array_push($feats, $feat);
            }

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
            $no_of_items = $_SESSION['no_of_inventory_items'];
            
            for($x = 1; $x <= $no_of_items; $x++) {
                $items_entries = array(
                    'item_name' => $_POST['item_name_' . $x],
                    'item_weight' => $_POST['item_weight_' . $x],
                    'item_quantity' => $_POST['item_quantity_' . $x]
                );

                $washed_items = Utils::washArray($items_entries);

                $item = new Item($washed_items);
                array_push($items_array, $item);
            }

            $inventory_entries = array(
                'light_load' => $_POST['inventory_light_load'],
                'medium_load' => $_POST['inventory_medium_load'],
                'heavy_load' => $_POST['inventory_heavy_load'],
                'lift_over_head' => $_POST['inventory_lift_over_head'],
                'lift_off_ground' => $_POST['inventory_lift_off_ground'],
                'push_or_drag' => $_POST['inventory_push_or_drag']
            );

            $washed_inventory = Utils::washArray($inventory_entries);
            $washed_inventory['items'] = $items_array;
            $inventory = new Inventory($washed_inventory);

            return $inventory;
        }

        public function createSavingThrowsArray() {
            $saving_throws = array();
            $categories = array('fortitude', 'reflex', 'will');

            foreach($categories as $category) {
                $saving_throw_entries = array(
                    'name' => $category,
                    'total' => $_POST['saving_throw_' . $category . '_total'],
                    'base_save' => $_POST['saving_throw_' . $category . '_base_save'],
                    'ability_mod' => $_POST['saving_throw_' . $category . '_ability_mod'],
                    'magic_mod' => $_POST['saving_throw_' . $category . '_magic_mod'],
                    'misc_mod' => $_POST['saving_throw_' . $category . '_misc_mod'],
                    'temp_mod' => $_POST['saving_throw_' . $category . '_temp_mod'],
                );

                $washed = Utils::washArray($saving_throw_entries);
                $saving_throw = new Saving_Throw($washed);
                array_push($saving_throws, $saving_throw);
            }

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

            $washed = Utils::washArray($armor_entries);
            $armor = new Armor($washed);

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

            $washed = Utils::washArray($shield_entries);
            $shield = new shield($washed);

            return $shield;
        }

        //TODO create comment
        public function createProtectiveItems() {

            $protective_items = array();

            for($i = 1; $i < $_SESSION['no_of_protective_items'] + 1; $i++) {
                $protective_item_entries = array(
                    'protective_item_name' => $_POST['protective_item_name_' . $i],
                    'protective_item_ac_bonus' => $_POST['protective_item_ac_bonus_' . $i],
                    'protective_item_weight' => $_POST['protective_item_weight_' . $i],
                    'protective_item_special_properties' => $_POST['protective_item_special_properties_' . $i]
                );

                $washed = Utils::washArray($protective_item_entries);
                $protective_item = new Protective_Item($washed);
                array_push($protective_items, $protective_item);
            }

            return $protective_items;
        }

    }

}