<?php
/**
 * A view class file for the create-character page
 */
require_once 'base.view.php';

if(!class_exists('Create_Character_View')) {

    class Create_Character_View extends Base_View {

        protected $page_id;

        public function __construct($model, $controller, $title, $page_id) {
            $this->page_id = $page_id;
            parent::__construct($model, $controller, $title, $page_id);
        }

        /**
         * A function to render the view
         */
        public function render() {
            include '../application/templates/head.html';

            $html = '' . "\n";
            $html .= $this->buildHeader($this->page_id);
            $html .= '<h1>Create Character</h1>' . "\n";
            $html .= $this->buildCharacterCreation();

            echo $html;

            include '../application/templates/footer.html';
        }

        /**
         * A function to build the character creation
         * @return string - the HTML representation of the character creation
         */
        public function buildCharacterCreation()  {
            $html = "";

            $html .= '<div id="character_creation">' . "\n";
            $html .= '<form name="create_character" action="' . $_SERVER['PHP_SELF'] . '" method="POST">' . "\n";
            $html .= $this->buildPersonalia();
            $html .= $this->buildStats();
            $html .= $this->buildAttributes();
            $html .= $this->buildSavingThrows();
            $html .= $this->buildAttacks();
            $html .= $this->buildArmors();
            $html .= $this->buildSkills();
            $html .= $this->buildPurse();
            $html .= $this->buildLanguages();
            $html .= $this->buildSpecialAbilities();
            $html .= $this->buildFeats();
            $html .= $this->buildInventory();
            $html .= '<input name="submit" type="submit" value="Create Character">' . "\n";
            $html .= '</form>' . "\n";
            $html .= '</div> <!-- end #character_creation -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheets personalia segment creation
         * @return string - the HTML representation of the personalia creation segment
         */
        public function buildPersonalia() {
            $html = "";

            $html .= '<div id="personalia_holder">' . "\n";
            $html .= '<h2>Personalia</h2>' . "\n";
            $html .= '<label for="name">Name: </label>';
            $html .= '<input id="name" name="name" type="text" maxlength="50" value="Character name">' . "\n";
            $html .= '<label for="class">Class: </label>';
            $html .= '<input id="class" name="class" type="text" maxlength="50" value="Character class">' . "\n";
            $html .= '<label for="level">Level: </label>';
            $html .= '<input id="level" name="level" type="number" value="1">' . "\n";
            $html .= '<label for="size">Size: </label>';
            $html .= '<input id="size" name="size" type="text" maxlength="10" value="M">' . "\n";
            $html .= '<label for="age">Age: </label>';
            $html .= '<input id="age" name="age" type="number" value="18">' . "\n";
            $html .= '<label for="gender">Gender: </label>';
            $html .= '<input id="gender" name="gender" type="text" maxlength="10" value="Male/female">' . "\n";
            $html .= '<label for="height">Height (cm): </label>';
            $html .= '<input id="height" name="height" type="number" value="180">' . "\n";
            $html .= '<label for="weight">Weight: (kg)</label>';
            $html .= '<input id="weight" name="weight" type="number" value="70">' . "\n";
            $html .= '<label for="eyes">Eyes: </label>';
            $html .= '<input id="eyes" name="eyes" type="text" maxlength="20" value="Eye color">' . "\n";
            $html .= '<label for="hair">Hair: </label>';
            $html .= '<input id="hair" name="hair" type="text" maxlength="20" value="Hair color">' . "\n";
            $html .= '<label for="skin">Skin: </label>';
            $html .= '<input id="skin" name="skin" type="text" maxlength="20" value="Skin color">' . "\n";
            $html .= '<label for="race">Race: </label>';
            $html .= '<input id="race" name="race" type="text" maxlength="40" value="Race">' . "\n";
            $html .= '<label for="alignment">Alignment: </label>';
            $html .= '<input id="alignment" name="alignment" type="text" maxlength="40" value="Alignment">' . "\n";
            $html .= '<label for="deity">Deity: </label>';
            $html .= '<input id="deity" name="deity" type="text" maxlength="40" value="Deity">' . "\n";
            $html .= '<label for="xp">XP: </label>';
            $html .= '<input id="xp" name="xp" type="number" value="1">' . "\n";
            $html .= '<label for="next_level">Next Level: </label>';
            $html .= '<input id="next_level" name="next_level" type="number" value="1000">' . "\n";
            $html .= '</div> <!-- end #personalia_holder -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's stats segment creation
         * @return string - the HTML representation of the stats creation segment
         */
        public function buildStats() {
            $html = "";

            $html .= '<div id="stats_holder">' . "\n";
            $html .= '<h2>Stats</h2>' . "\n";
            $html .= '<label for="hp">HP: </label>';
            $html .= '<input id="hp" name="hp" type="number" value="1">' . "\n";
            $html .= '<label for="wounds">Wounds: </label>';
            $html .= '<input id="wounds" name="wounds" type="number" value="0">' . "\n";
            $html .= '<label for="non_lethal">Non Lethal: </label>';
            $html .= '<input id="non_lethal" name="non_lethal" type="number" value="0">' . "\n";
            $html .= '<label for="initiative_mod">Initiative Modifier: </label>';
            $html .= '<input id="initiative_mod" name="initiative_mod" type="number" value="0">' . "\n";
            $html .= '<label for="spell_resistance">Spell Resistance: </label>';
            $html .= '<input id="spell_resistance" name="spell_resistance" type="number" value="0">' . "\n";
            $html .= '<label for="speed">Speed: </label>';
            $html .= '<input id="speed" name="speed" type="number" value="0">' . "\n";
            $html .= $this->buildArmorClass();
            $html .= '<label for="touch_ac">Touch AC: </label>';
            $html .= '<input id="touch_ac" name="touch_ac" type="number" value="0">' . "\n";
            $html .= '<label for="flat_footed">Flat Footed: </label>';
            $html .= '<input id="flat_footed" name="flat_footed" type="number" value="0">' . "\n";
            $html .= '<label for="damage_reduction">Damage Reduction: </label>';
            $html .= '<input id="damage_reduction" name="damage_reduction" type="number" value="0">' . "\n";
            $html .= '</div> <!-- end #stats_holder -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's attributes creation segment
         * @return string - the HTML represantation of the attributes creation segment
         */
        public function buildAttributes() {
            $categories = array('strength', 'constitution', 'dexterity', 'intelligence', 'wisdom', 'charisma');
                        
            $html = '';

            $html .= '<div id="attributes_holder">' . "\n";
            $html .= '<h3>Attributes</h3>' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '<td>Ability Modifier</td>' . "\n";
            $html .= '<td>Temp Score</td>' . "\n";
            $html .= '<td>Temp Modifier</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";
            
            foreach($categories as $category) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="' . $category . '_score">' . ucfirst($category) . ': </label>';
                $html .= '<input id="' . $category . '_score" name="' . $category . '_score"';
                $html .= ' type="number" min="3" value="10"></td>';
                $html .= '<td><input id="' . $category . '_mod" name="' . $category . '_mod" type="number" min="0" value="10"></td>' . "\n";
                $html .= '<td><input id="' . $category . '_temp_score" name="' . $category . '_temp_score" type="number" min="0" value="10"></td>' . "\n";
                $html .= '<td><input id="' . $category . '_temp_mod" name="' . $category . '_temp_mod" type="number" min="0" value="10"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end attbributes_holder -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's armor class creation segment
         * @return string - the HTML represantation of the armor class creation segment
         */
        public function buildArmorClass() {
            $html = "";

            $html .= '<div id="armor_class_holder">' . "\n";
            $html .= '<h3>Armor Class</h3>' . "\n";
            $html .= '<label for="ac_total">Total: </label>';
            $html .= '<input id="ac_total" name="ac_total" type="number" min="0" value="10">' . "\n";
            $html .= '<label for="ac_base">AC Base: </label>';
            $html .= '<input id="ac_base" name="ac_base" type="number" value="10">' . "\n";
            $html .= '<label for="ac_armor_bonus">Armor Bonus: </label>';
            $html .= '<input id="ac_armor_bonus" name="ac_armor_bonus" type="number" value="1">' . "\n";
            $html .= '<label for="ac_shield_bonus">Shield Bonus: </label>';
            $html .= '<input id="ac_shield_bonus" name="ac_shield_bonus" type="number" value="1">' . "\n";
            $html .= '<label for="ac_dex_mod">Dex Modifier: </label>';
            $html .= '<input id="ac_dex_mod" name="ac_dex_mod" type="number" value="1">' . "\n";
            $html .= '<label for="ac_size_mod">Size Modifier: </label>';
            $html .= '<input id="ac_size_mod" name="ac_size_mod" type="number" value="1">' . "\n";
            $html .= '<label for="ac_natural_armor">Natural Armor: </label>';
            $html .= '<input id="ac_natural_armor" name="ac_natural_armor" type="number" value="1">' . "\n";
            $html .= '</div> <!-- end #armor_class_holder -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's attacks creation segment
         * @return string - the HTML represantation of the attacks creation segment
         */
        public function buildAttacks() {
            $html = "";

            $html .= '<div id="attacks_holder">' . "\n";
            $html .= '<h2>Attacks</h2>' . "\n";
            $html .= '<label for="base_attack_bonus">Base Attack Bonus: </label>';
            $html .= '<input id="base_attack_bonus" name="base_attack_bonus" type="number" value="0">' . "\n";
            $html .= '<label for="attacks_per_round">Attacks Per Round: </label>';
            $html .= '<input id="attacks_per_round" name="attacks_per_round" type="number" value="1">' . "\n";
            $html .= $this->buildGrapple();
            $html .= $this->buildAttack();

            $html .= '</div> <!-- end #attacks_holder -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's grapple creation segment
         * @return string - the HTML represantation of the grapple creation segment
         */
        public function buildGrapple() {
            $html = "";

            $html .= '<div id="grapple_holder">' . "\n";
            $html .= '<h3>Grapple</h3>' . "\n";
            $html .= '<label for="grapple_total">Total: </label>';
            $html .= '<input id="grapple_total" name="grapple_total" type="number" value="1">' . "\n";
            $html .= '<label for="grapple_bab">Base Attack Bonus: </label>';
            $html .= '<input id="grapple_bab" name="grapple_bab" type="number" value="1">' . "\n";
            $html .= '<label for="grapple_str_mod">Strength Modifier: </label>';
            $html .= '<input id="grapple_str_mod" name="grapple_str_mod" type="number" value="1">' . "\n";
            $html .= '<label for="grapple_size_mod">Size Modifier: </label>';
            $html .= '<input id="grapple_size_mod" name="grapple_size_mod" type="number" value="1">' . "\n";
            $html .= '<label for="grapple_misc_mod">Misc. Modifier: </label>';
            $html .= '<input id="grapple_misc_mod" name="grapple_misc_mod" type="number" value="1">' . "\n";
            $html .= '</div> <!-- end #grapple_holder -->' . "\n";
            return $html;
        }

        /**
         * A method to build the character sheet's attack creation segment
         * @return string - the HTML represantation of the attack creation segment
         */
        public function buildAttack() {
            $no_of_atts = 4;
            $html = '';

            $html .= '<div id="attack_holder">' . "\n";
            $html .= '<table>' . "\n";

            for($i = 0; $i < $no_of_atts; $i++) {
                $html .= '<tr>' . "\n";
                $html .= '<td><h3>Attack ' . $i . '</h3></td>' . "\n";
                $html .= '</tr>' . "\n";
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="attack_name_' . $i . '">Name: </label><input id="attack_name_' . $i . '" name="attack_name_' . $i . '" type="text" maxlength="50" value="Name"></td>' . "\n";
                $html .= '<td><label for="attack_bonus_' . $i . '">Attack Bonus: </label><input id="attack_bonus_' . $i . '" name="attack_bonus_' . $i . '" type="number" value="1"></td>' . "\n";
                $html .= '<td><label for="attack_damage_' . $i . '">Damage: </label><input id="attack_damage_' . $i . '" name="attack_damage_' . $i . '" type="text" maxlength="20" value="2d4 + 2"></td>' . "\n";
                $html .= '<td><label for="critical_floor_' . $i . '">Critical Range:</label><input id="critical_floor_' . $i . '" name="critical_floor_' . $i . '" type="number" value="19">';
                $html .= '<input id="critical_ceiling_' . $i . '" name="critical_ceiling_' . $i . '" type="number" value="20"></td>' . "\n";
                $html .= '</tr>' . "\n";

                $html .= '<tr>' . "\n";
                $html .= '<td><label for="weapon_range_' . $i . '">Weapon Range: </label><input id="weapon_range_' . $i . '" name="weapon_range_' . $i . '" type="number" value="100"></td>' . "\n";
                $html .= '<td><label for="attack_type_' . $i . '">Type: </label><input id="attack_type_' . $i . '" name="attack_type_' . $i . '" type="text" value="slashing" maxlength="50"></td>' . "\n";
                $html .= '<td><label for="attack_notes_' . $i . '">Notes: </label><input id="attack_notes_' . $i . '" name="attack_notes_' . $i . '" value="some notes" type="text"></td>' . "\n";
                $html .= '<td><label for="ammunition_' . $i . '">Ammunition: </label><input id="ammunition_' . $i . '" name="ammunition_' . $i . '" value="20" min="0" type="number"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #attack_holder -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's skills creation segment
         * @return string - the HTML represantation of the skills creation segment
         */
        public function buildSkills() {
            $html = '';

            //templates mock-up
            $sleight_of_hand = new Skill_Template('sleight_of_hand', 'Sleight Of Hand', 'dex', 'sleight of hand description here ...');
            $pick_lock = new Skill_Template('pick_lock', 'Pick Lock', 'dex', 'pick lock description here ...');
            $ride_horse = new Skill_Template('ride_horse', 'Ride Horse', 'dex', 'ride horse description here ...');

            $templates_array = array ($sleight_of_hand, $pick_lock, $ride_horse);

            $html .= '<div id="skills_holder">' . "\n";
            $html .= '<h2>Skills</h2>' . "\n";
            $html .= '<label for="max_ranks_class">Max Ranks Class: </label>';
            $html .= '<input name="max_ranks_class" id="max_ranks_class" type="number" value="4">' . "\n";
            $html .= '<label for="max_ranks_cross_class">Max Ranks Cross Class: </label>';
            $html .= '<input name="max_ranks_cross_class" id="max_ranks_cross_class" type="number" value="4">' . "\n";

            $html .= '<div id="skill_holder">' . "\n";

            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td>Skill</td>' . "\n";
            $html .= '<td>Key Ability</td>' . "\n";
            $html .= '<td>Skill Modifier</td>' . "\n";
            $html .= '<td>Ability Modifier</td>' . "\n";
            $html .= '<td>Ranks</td>' . "\n";
            $html .= '<td>Misc Modifier</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";

            foreach($templates_array as $template) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="skill_' . $template->getTemplateName() . '_skill_mod">' . $template->getCommonName() . ': </label></td>' . "\n";
                $html .= '<td>(' . strtoupper($template->getKeyAbility()) . ')</td>' . "\n";

                $html .= '<td><input id="skill_' . $template->getTemplateName() . '_skill_mod" ';
                $html .= 'name="skill_' . $template->getTemplateName() . '_skill_mod" type="number" value="2"></td>' . "\n";

                $html .= '<td><input id="skill_' . $template->getTemplateName() . '_ability_mod" ';
                $html .= 'name="skill_' . $template->getTemplateName(). '_ability_mod" type="number" value="3"></td>' . "\n";

                $html .= '<td><input id="skill_' . $template->getTemplateName() . '_ranks" ';
                $html .= 'name="skill_' . $template->getTemplateName() . '_ranks" type="number" value="4"></td>' . "\n";

                $html .= '<td><input id="skill_' . $template->getTemplateName() . '_misc_mod" ';
                $html .= 'name="skill_' . $template->getTemplateName() . '_misc_mod" type="number" value="5"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";

            $html .= '</div> <!-- end #skill_holder -->' . "\n";

            $html .= '</div> <!-- end #skills_holder -->' . "\n";

            return $html;

        }
        
        public function buildPurse() {
            $html = '';

            $html .= '<div id="purse_holder">' . "\n";
            $html .= '<h2>Purse</h2>' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td>Currency</td>' . "\n";
            $html .= '<td>Amount</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td><label for="gold">Gold: </label></td>' . "\n";
            $html .= '<td><input id="gold" name="gold" type="number" value="1"></td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td><label for="silver">Silver: </label></td>' . "\n";
            $html .= '<td><input id="silver" name="silver" type="number" value="1"></td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td><label for="copper">Copper: </label></td>' . "\n";
            $html .= '<td><input id="copper" name="copper" type="number" value="1"></td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #purse_holder -->' . "\n";
            
            return $html;
        }

        public function buildLanguages() {
            $languages_base = 6;

            $html = '';

            $html .= '<div id="languages_holder">' . "\n";
            $html .= '<h2>Languages</h2>' . "\n";
            $html .= '<label for="max_no_of_languages">Max. no Languages: </label>';
            $html .= '<input id="max_no_of_languages" name="max_no_of_languages" type="number" value="1">' . "\n";

            $html .= '<table>' . "\n";

            for($x = 0; $x < $languages_base; $x++) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="language' . $x . '">Language ' . $x . ': </label></td>' . "\n";
                $html .= '<td><input id="language' . $x . '" name="language' . $x . '" type="text" value="a language"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";

            $html .= '</div> <!-- end #languages_holder -->' . "\n";

            return $html;
        }

        public function buildSpecialAbilities() {
            $html = '';

            $html .= '<div id="special_abilities_holder">' . "\n";
            $html .= '<h2>Special Abilities</h2>' . "\n";
            $html .= '<table>' . "\n";

            for($x = 0; $x < NO_OF_SPECIAL_ABILITIES; $x++) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="special_ability' . $x . '">Special Ability ' . $x . ': </label></td>' . "\n";
                $html .= '<td><input id="special_ability' . $x . '" name="special_ability'. $x . '"';
                $html .= ' type="text" value="special ability ' . $x . '"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #special_abilities_holder -->' . "\n";

            return $html;
        }

        public function buildFeats() {
            $html = '';

            $html .= '<div id="feats_holder">' . "\n";
            $html .= '<h2>Feats</h2>' . "\n";
            $html .= '<table>' . "\n";

            for($x = 0; $x < NO_OF_FEATS; $x++) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="feat' . $x . '">Feat ' . $x . ': </label></td>' . "\n";
                $html .= '<td><input id="feat' . $x . '" name="feat' . $x . '" type="text" value="feat' . $x . '"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #feats_holder -->' . "\n";

            return $html;
        }

        public function buildInventory() {
            $html = '';

            $html .= '<div id="inventory_holder">' . "\n";
            $html .= '<h2>Inventory</h2>' . "\n";
            
            $html .= '<label for="light_load">Light Load: </label>';
            $html .= '<input id="light_load" name="light_load" type="number" min="0" value="1">' . "\n";
            $html .= '<label for="medium_load">Medium Load: </label>';
            $html .= '<input id="medium_load" name="medium_load" type="number" min="0" value="2">' . "\n";
            $html .= '<label for="heavy_load">Heavy Load: </label>';
            $html .= '<input id="heavy_load" name="heavy_load" type="number" min="0" value="3">' . "\n";
            $html .= '<label for="lift_over_head">Lift Over Head: </label>';
            $html .= '<input id="lift_over_head" name="lift_over_head" type="number" min="0" value="4">' . "\n";
            $html .= '<label for="lift_off_ground">Lift Off Ground: </label>';
            $html .= '<input id="lift_off_ground" name="lift_off_ground" type="number" min="0" value="5">' . "\n";
            $html .= '<label for="push_or_drag">Push Or Drag: </label>';
            $html .= '<input id="push_or_drag" name="push_or_drag" type="number" min="0" value="6">' . "\n";

            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td>Item Name</td>' . "\n";
            $html .= '<td>Weight</td>' . "\n";
            $html .= '<td>Quantity</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";

            for($x = 0; $x < NO_OF_INVENTORY_ITEMS; $x++) {
                $html .= '<tr>' . "\n";
                $html .= '<td><input name="item_name' . $x . '" type="text" value="Item ' . $x . '"></td>' . "\n";
                $html .= '<td><input name="item_weight' . $x . '" type="number" min="0" value="2"></td>' . "\n";
                $html .= '<td><input name="item_quantity' . $x . '" type="number" min="0" value="3"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #inventory_holder -->' . "\n";

            return $html;
        }

        public function buildSavingThrows() {
            $categories = array(
                'fortitude' => 'constitution',
                'reflex' => 'dexterity',
                'will' => 'wisdom'
            );

            $html = '';

            $html .= '<div id="saving_throws_holder">' . "\n";
            $html .= '<h2>Saving Throws</h2>' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '<td>Total</td>' . "\n";
            $html .= '<td>Base Save</td>' . "\n";
            $html .= '<td>Ability Modifier</td>' . "\n";
            $html .= '<td>Magic Modifier</td>' . "\n";
            $html .= '<td>Misc Modifier</td>' . "\n";
            $html .= '<td>Temp Modifier</td>' . "\n";
            $html .= '</tr>' . "\n";

            foreach($categories as $key => $value) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="saving_throw_' . $key . '_total">' . ucfirst($key) . ': </label></td>' . "\n";
                $html .= '<td><input id="saving_throw_' . $key . '_total" name="saving_throw_' . $key . '_total" type="number" min="0" value="1"></td>' . "\n";
                $html .= '<td><input name="saving_throw_' . $key . '_base_save" type="number" min="0" value="1"></td>' . "\n";
                $html .= '<td><input name="saving_throw_' . $key . '_ability_modifier" type="number" min="0" value="2"></td>' . "\n";
                $html .= '<td><input name="saving_throw_' . $key . '_magic_modifier" type="number" min="0" value="3"></td>' . "\n";
                $html .= '<td><input name="saving_throw_' . $key . '_misc_modifier" type="number" min="0" value="4"></td>' . "\n";
                $html .= '<td><input name="saving_throw_' . $key . '_temp_modifier" type="number" min="0" value="5"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #saving_throws_holder -->' . "\n";

            return $html;
        }

        public function buildArmors() {
            $html = '';

            $html .= '<div id="armors_holder">' . "\n";
            $html .= '<h2>Armors</h2>' . "\n";
            $html .= $this->buildArmor();
            $html .= $this->buildShield();
            $html .= $this->buildProtectiveItems();
            $html .= '</div> <!-- end #armors_holder -->' . "\n";

            return $html;
        }

        public function buildArmor() {
            $armor_segments = array(
                'armor_name' => 'Armor Name',
                'armor_type' => 'Type',
                'armor_ac_bonus' => 'AC Bonus',
                'armor_max_dex' => 'Max Dex',
                'armor_check_penalty' => 'Check Penalty',
                'armor_spell_failure' => 'Spell Failure',
                'armor_speed' => 'Speed',
                'armor_weight' => 'Weight',
                'armor_special_properties' => 'Special Properties'
            );

            $html = '';
            $html .= '<h3>Armor</h3>' . "\n";
            foreach($armor_segments as $key => $value) {
                $html .= '<label for="' . $key . '">' . $value . ': </label>';
                $html .= '<input id="' . $key . '" name="' . $key . '" type="text">' . "\n";
            }

            return $html;
        }

        public function buildShield() {
            $shield_segments = array(
                'shield_name' => 'Name',
                'shield_ac_bonus' => 'AC Bonus',
                'shield_weight' => 'Weight',
                'shield_check_penalty' => 'Check Penalty',
                'shield_spell_failure' => 'Spell Failure',
                'shield_special_properties' => 'Special Properties'
            );

            $html = '';
            $html .= '<h3>Shield</h3>' . "\n";

            foreach($shield_segments as $key => $value) {
                $html .= '<label for="' . $key . '">' . $value . ': </label>';
                $html .= '<input id="' . $key . '" name="' . $key . '" type="text">' . "\n";
            }

            return $html;
        }

        public function buildProtectiveItems() {
            $protective_item_segments = array(
                'prot_item_name' => 'Name',
                'prot_item_ac_bonus' => 'AC Bonus',
                'prot_item_weight' => 'Weight',
                'prot_item_special_properties' => 'Special Properties'
            );

            $html = '';

            for($i = 0; $i < NO_OF_PROTECTIVE_ITEMS; $i++) {
                $html .= '<h3>Protective Item ' . $i . '</h3>' . "\n";

                foreach($protective_item_segments as $key => $value) {
                    $html .= '<label for="' . $key . '_' . $i . '">' . $value . ': </label>';
                    $html .= '<input id="' . $key . '_' . $i . '" name="' . $key . '_' . $i . '" type="text">' . "\n";
                }

            }

            return $html;
        }

    }

}