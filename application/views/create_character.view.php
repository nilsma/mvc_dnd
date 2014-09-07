<?php
/**
 * A view class file for the application's create_charater page
 */
if(!class_exists('Member_View')) {

    class Create_Character_View extends Base_View {

        protected $page_id;
        protected $model;

        public function __construct(Create_Character_Model $model, $controller, $title, $page_id) {
            $this->page_id = $page_id;
            $this->model = $model;
            parent::__construct($model, $controller, $title, $page_id);
        }

        public function render() {
            include '../application/templates/head.html';

            $html = '' . "\n";
            $html .= $this->buildHeader($this->page_id);
            $html .= $this->buildCreationForm();

            echo $html;

            include '../application/templates/footer.html';
        }

        public function buildCreationForm() {
            $html = '';

            $html .= '<div id="character_creation">' . "\n";
            $html .= '<form name="create_character" action="' . $_SERVER['PHP_SELF'] . '" method="POST">' . "\n";
            $html .= $this->buildPersonaliaInputs();
            $html .= $this->buildAttributesInputs();
            $html .= $this->buildSavingThrowsInputs();
            $html .= $this->buildStatsInputs();
            $html .= $this->buildAttacksInputs();
            $html .= $this->buildSkillsInputs();
            $html .= $this->buildGearInputs();
            $html .= $this->buildInventoryInputs();
            $html .= $this->buildFeatsInputs();
            $html .= $this->buildSpecialAbilitiesInputs();
            $html .= $this->buildLanguagesInputs();
            $html .= '<input id="submit" name="submit" type="submit" value="Create Character">' . "\n";
            $html .= '</form>' . "\n";
            $html .= '</div> <!-- end #character_creation -->' . "\n";

            return $html;
        }

        public function buildLanguagesInputs() {
            $html = '';

            $html .= '<div id="languages_creation">' . "\n";
            $html .= '<h3>Languages</h3>' . "\n";
            $html .= '<label for="lang_name">Language: </label>';
            $html .= '<input id="lang_name" name="lang_name" type="text" maxlength="40">' . "\n";
            $html .= '</div> <!-- end #languages_creation -->' . "\n";

            return $html;
        }

        public function buildGearInputs() {
            $html = '';

            $html .= '<div id="gear_creation">' . "\n";
            $html .= '<h3>Gear</h3>' . "\n";
            $html .= $this->buildArmorInputs();
            $html .= $this->buildShieldInputs();
            $html .= $this->buildProtectiveItemInputs();
            $html .= '</div> <!-- end #gear_creation -->' . "\n";

            return $html;
        }
        
        public function buildProtectiveItemInputs() {
            $html = '';
            
            $html .= '<div id="protective_item_creation">' . "\n";
            $html .= '<h4>Protective Item: </h4>' . "\n";
            $html .= '<label for="prot_item_name">Name: </label>';
            $html .= '<input id="prot_item_name" name="prot_item_name" type="text" maxlength="50">' . "\n";
            $html .= '<label for="prot_item_ac_bonus">AC Bonus: </label>';
            $html .= '<input id="prot_item_ac_bonus" name="prot_item_ac_bonus" type="text" maxlength="50">' . "\n";
            $html .= '<label for="prot_item_weight">Weight: </label>';
            $html .= '<input id="prot_item_weight" name="prot_item_weight" type="text" maxlength="50">' . "\n";
            $html .= '<label for="prot_item_special_properties">Special Properties: </label>';
            $html .= '<input id="prot_item_special_properties" name="prot_item_special_properties" type="text" maxlength="50">' . "\n";
            $html .= '</div> <!-- end #protective_item_creation -->' . "\n";
            
            return $html;
        }

        public function buildShieldInputs() {
            $html = '';

            $html .= '<div id="shield_creation">' . "\n";
            $html .= '<h4>Shield: </h4>' . "\n";
            $html .= '<label for="shield_name">Name: </label>';
            $html .= '<input id="shield_name" name="shield_name" type="text" maxlength="50">' . "\n";
            $html .= '<label for="shield_ac_bonus">AC Bonus: </label>'; 
            $html .= '<input id="shield_ac_bonus" name="shield_ac_bonus" type="number">' . "\n";
            $html .= '<label for="shield_weight">Weight: </label>';
            $html .= '<input id="shield_weight" name="shield_weight" type="number">' . "\n";
            $html .= '<label for="shield_check_penalty">Check Penalty: </label>';
            $html .= '<input id="shield_check_penalty" name="shield_check_penalty" type="number">' . "\n";
            $html .= '<label for="shield_spell_failure">Spell Failure: </label>';
            $html .= '<input id="shield_spell_failure" name="shield_spell_failure" type="number">' . "\n";
            $html .= '<label for="shield_special_properties">Special Properties: </label>';
            $html .= '<input id="shield_special_properties" name="shield_special_properties" type="text" maxlength="200">' . "\n";
            $html .= '</div> <!-- end #shield_creation -->' . "\n";

            return $html;
        }

        public function buildArmorInputs() {
            $html = '';

            $html .= '<div id="armor_creation">' . "\n";
            $html .= '<h4>Armor: </h4>' . "\n";
            $html .= '<label for="armor_name">Name: </label>';
            $html .= '<input id="armor_name" name="armor_name" type="text" maxlength="50">' . "\n";
            $html .= '<label for="armor_type">Type: </label>';
            $html .= '<input id="armor_type" name="armor_type" type="text" maxlength="50">' . "\n";
            $html .= '<label for="armor_ac_bonus">AC Bonus: </label>';
            $html .= '<input id="armor_ac_bonus" name="armor_ac_bonus" type="number">' . "\n";
            $html .= '<label for="armor_max_dex">Max Dex: </label>';
            $html .= '<input id="armor_max_dex" name="armor_max_dex" type="number">' . "\n";
            $html .= '<label for="armor_check_penalty">Check Penalty: </label>';
            $html .= '<input id="armor_check_penalty" name="armor_check_penalty" type="number">' . "\n";
            $html .= '<label for="armor_spell_failure">Spell Failure: </label>';
            $html .= '<input id="armor_spell_failure" name="armor_spell_failure" type="number">' . "\n";
            $html .= '<label for="armor_speed">Speed: </label>';
            $html .= '<input id="armor_speed" name="armor_speed" type="number">' . "\n";
            $html .= '<label for="armor_weight">Weight: </label>';
            $html .= '<input id="armor_weight" name="armor_weight" type="number">' . "\n";
            $html .= '<label for="armor_special_properties">Special Properties: </label>';
            $html .= '<input id="armor_special_properties" name="armor_special_properties" type="text" maxlength="200">' . "\n";
            $html .= '</div> <!-- end #armor_creation -->' . "\n";

            return $html;
        }

        public function buildInventoryInputs() {
            $html = '';

            return $html;
        }

        public function buildPersonaliaInputs() {
            $html = '';

            $html .= '<div id="personalia_creation">' . "\n";
            $html .= '<h3>Personalia</h3>' . "\n";
            $html .= '<label for="name">Name: </label>';
            $html .= '<input id="name" name="name" type="text" maxlength="50" required>' . "\n";
            $html .= '<label for="class">Class: </label>' . "\n";
            $html .= '<input id="class" name="class" type="text" maxlength="50" required>' . "\n";
            $html .= '<label for="level">Level: </label>';
            $html .= '<input id="level" name="level" type="number" required>' . "\n";
            $html .= '<label for="size">Size: </label>';
            $html .= '<input id="size" name="size" type="text" maxlength="1" required>' . "\n";
            $html .= '<label for="age">Age: </label>';
            $html .= '<input id="age" name="age" type="number" required>' . "\n";
            $html .= '<label for="gender">Gender: </label>';
            $html .= '<input id="gender" name="gender" type="text" maxlength="10" required>' . "\n";
            $html .= '<label for="height">Height: </label>';
            $html .= '<input id="height" name="height" type="number" required>' . "\n";
            $html .= '<label for="weight">Weight: </label>';
            $html .= '<input id="weight" name="weight" type="number" required>' . "\n";
            $html .= '<label for="eyes">Eyes: </label>';
            $html .= '<input id="eyes" name="eyes" type="text" maxlength="20" required>' . "\n";
            $html .= '<label for="hair">Hair: </label>';
            $html .= '<input id="hair" name="hair" type="text" maxlength="20" required>' . "\n";
            $html .= '<label for="skin">Skin: </label>';
            $html .= '<input id="skin" name="skin" type="text" maxlength="20" required>' . "\n";
            $html .= '<label for="race">Race: </label>';
            $html .= '<input id="race" name="race" type="text" maxlength="30" required>' . "\n";
            $html .= '<label for="alignment">Alignment: </label>';
            $html .= '<input id="alignment" name="alignment" type="text" maxlength="20" required>' . "\n";
            $html .= '<label for="deity">Deity: </label>';
            $html .= '<input id="deity" name="deity" type="text" maxlength="30" required>' . "\n";
            $html .= '<label for="xp">XP: </label>';
            $html .= '<input id="xp" name="xp" type="number" required>' . "\n";
            $html .= '<label for="next_level">Next Level: </label>';
            $html .= '<input id="next_level" name="next_level" type="number" required>' . "\n";
            $html .= '</div> <!-- end #personalia_creation -->' . "\n";

            return $html;
        }

        public function buildAttributesInputs() {
            $attributes = array('str', 'dex', 'con', 'int', 'wis', 'cha');

            $html = '';

            $html .= '<div id="attributes_creation">' . "\n";
            $html .= '<h3>Attributes: </h3>' . "\n";
            $html .= '<p>(Ability name: ability score / ability modifier / temporary score / temporary modifier)</p>' . "\n";

            foreach($attributes as $attribute) {
                $html .= '<p>' . "\n";
                $html .= '<span class="attribute_name">' . strtoupper($attribute) . ': </span>' . "\n";
                $html .= '<input name="' . $attribute . '_ability_score" type="number" required>' . "\n";
                $html .= '<input name="' . $attribute . '_ability_mod" type="number" required>' . "\n";
                $html .= '<input name="' . $attribute . '_temp_score" type="number" value="0" required>' . "\n";
                $html .= '<input name="' . $attribute . '_temp_mod" type="number" value="0" required>' . "\n";
                $html .= '</p>' . "\n";
            }
            $html .= '</div> <!-- end #attributes_creation -->' . "\n";

            return $html;
        }

        public function buildSavingThrowsInputs() {
            $saving_throws = array('fortitude (con)', 'reflex (dex)', 'will (wis)');
            $html = '';

            $html .= '<div id="saving_throws_creation">' . "\n";
            $html .= '<h3>Saving Throws: </h3>' . "\n";
            $html .= '<p>Saving throw: total / base save / ability mod / magic mod / misc mod / temp mod</p>' . "\n";

            foreach($saving_throws as $saving_throw) {
                $html .= '<p>' . "\n";
                $html .= '<span class="saving_throw_name">' . $saving_throw . '</span>: ' . "\n";
                $html .= '<input name="' . $saving_throw . '_total" type="number" required> = ';
                $html .= '<input name="' . $saving_throw . '_base_save" type="number" required> + ';
                $html .= '<input name="' . $saving_throw . '_ability_mod" type="number" required> + ';
                $html .= '<input name="' . $saving_throw . '_magic_mod" type="number" value="0" required> + ';
                $html .= '<input name="' . $saving_throw . '_misc_mod" type="number" value="0" required> + ';
                $html .= '<input name="' . $saving_throw . '_temp_mod" type="number" value="0" required>';
                $html .= '</p>' . "\n";
            }

            $html .= '</div> <!-- end #saving_throws_creation -->' . "\n";

            return $html;
        }

        public function buildStatsInputs() {
            $html = '';

            $html .= '<div id="stats_creation">' . "\n";
            $html .= '<h3>Stats</h3>' . "\n";
            $html .= '<label for="hp">HP: </label>';
            $html .= '<input id="hp" name="hp" type="number" required>' . "\n";
            $html .= '<label for="non_lethal">Non Lethal: </label>';
            $html .= '<input id="non_lethal" name="non_lethal" type="number" required>' . "\n";
            $html .= '<label for="speed">Speed: </label>';
            $html .= '<input id="speed" name="speed" type="number" required>' . "\n";
            $html .= '<label for="initiative_mod">Initiative Modifier: </label>';
            $html .= '<input id="initiative_mod" name="initiative_mod" type="number" required>' . "\n";
            $html .= $this->buildArmorClassInputs();
            $html .= '</div> <!-- end stats_creation -->' . "\n";

            return $html;
        }

        public function buildArmorClassInputs() {
            $html = '';

            $html .= '<div id="armor_class_creation">' . "\n";
            $html .= '<h4>Armor Class</h4>' . "\n";
            $html .= '<label for="ac_total">Total: </label>';
            $html .= '<input id="ac_total" name="ac_total" type="number" required>' . "\n";
            $html .= '<label for="ac_base">Base AC: </label>';
            $html .= '<input id="ac_base" name="ac_base" type="number" required>' . "\n";
            $html .= '<label for="ac_armor_bonus">Armor Bonus: </label>';
            $html .= '<input id="ac_armor_bonus" name="ac_armor_bonus" type="number" required>' . "\n";
            $html .= '<label for="ac_shield_bonus">Shield Bonus: </label>';
            $html .= '<input id="ac_shield_bonus" name="ac_shield_bonus" type="number" required>' . "\n";
            $html .= '<label for="ac_dex_mod">Dex Modifier: </label>';
            $html .= '<input id="ac_dex_mod" name="ac_dex_mod" type="number" required>' . "\n";
            $html .= '<label for="ac_size_mod">Size Modifier: </label>';
            $html .= '<input id="ac_size_mod" name="ac_size_mod" type="number" required>' . "\n";
            $html .= '<label for="ac_natural_armor">Natural Armor: </label>';
            $html .= '<input id="ac_natural_armor" name="ac_natural_armor" type="number" required>' . "\n";
            $html .= '<label for="touch_ac">Touch AC: </label>';
            $html .= '<input id="touch_ac" name="touch_ac" type="number" required>' . "\n";
            $html .= '<label for="flat_footed">Flat Footed: </label>';
            $html .= '<input id="flat_footed" name="flat_footed" type="number" required>' . "\n";
            $html .= '<label for="damage_reduction">Damage Reduction: </label>';
            $html .= '<input id="damage_reduction" name="damage_reduction" type="number" required>' . "\n";
            $html .= '<label for="spell_resistance">Spell Resistance: </label>';
            $html .= '<input id="spell_resistance" name="spell_resistance" type="number" required>' . "\n";
            $html .= '</div> <!-- end #armor_class_creation -->' . "\n";

            return $html;
        }

        public function buildAttacksInputs() {
            $html = '';

            $html .= '<div id="attacks_creation">' . "\n";
            $html .= '<h3>Attacks</h3>' . "\n";
            $html .= '<label for="bab">Base Attack Bonus: </label><input id="bab" name="bab" type="text" maxlength="20" required>' . "\n";
            $html .= '<label for="no_of_att">Number of Attacks: </label><input id="no_of_att" name="no_of_att" type="number" required>' . "\n";
            $html .= $this->buildGrappleInputs();
            $html .= $this->buildSingleAttackInputs();
            $html .= '</div> <!-- end #attacks_creation -->' . "\n";

            return $html;
        }

        public function buildGrappleInputs() {
            $html = '';

            $html .= '<h4>Grapple: </h4>' . "\n";
            $html .= '<label for="grapple_total">Total: </label><input id="grapple_total" name="grapple_total" type="number" required>' . "\n";
            $html .= '<label for="grapple_bab">Base Attack Bonus: </label><input id="grapple_bab" name="grapple_bab" type="number" required>' . "\n";
            $html .= '<label for="grapple_str_mod">Strength Modifier: </label><input id="grapple_str_mod" name="grapple_str_mod" type="number" required>' . "\n";
            $html .= '<label for="grapple_size_mod">Size Modifier: </label><input id="grapple_size_mod" name="grapple_size_mod" type="number" required>' . "\n";
            $html .= '<label for="grapple_misc_mod">Misc Modifier: </label><input id="grapple_misc_mod" name="grapple_misc_mod" type="number" required>' . "\n";

            return $html;
        }

        public function buildSingleAttackInputs() {
            $html = '';

            $html .= '<h4>Attack: </h4>' . "\n";
            $html .= '<label for="att_name">Name: </label><input id="att_name" name="att_name" type="text" maxlength="30" required>' . "\n";
            $html .= '<label for="att_bonus">Attack Bonus: </label><input id="att_bonus" name="att_bonus" type="number" required>' . "\n";
            $html .= '<label for="att_damage">Damage: </label><input id="att_damage" name="att_damage" type="text" maxlength="10" required>' . "\n";
            $html .= '<label for="critical_floor">Critical Floor: </label><input id="critical_floor" name="critical_flor" type="number" required>' . "\n";
            $html .= '<label for="critical_ceiling">Critical Ceiling: </label><input id="critical_ceiling" name="critical_ceiling" type="number" required>' . "\n";
            $html .= '<label for="weapon_range">Range: </label><input id="weapon_range" name="weapon_range" type="number" required>' . "\n";
            $html .= '<label for="weapon_type">Type: </label><input id="weapon_type" name="weapon_type" type="text" maxlength="1" required>' . "\n";
            $html .= '<label for="weapon_notes">Notes: </label><input id="weapon_notes" name="weapon_notes" type="text" maxlength="140" required>' . "\n";
            $html .= '<label for="weapon_ammo">Ammunition: </label><input id="weapon_ammo" name="weapon_ammo" type="number">' . "\n";

            return $html;
        }

        public function buildSkillsInputs() {
            $skill_templates = $this->model->getSkillsTemplates();

            $html = '';

            $html .= '<div id="skills_creation">' . "\n";
            $html .= '<h4>Skills: </h4>' . "\n";
            $html .= '<p class="skill_ranks">Max ranks (class/cross-class): 4/2</p>' . "\n";
            $html .= '<p>(skill name (key ability): total = ability modifier + ranks + misc modifier)</p>' . "\n";

            foreach($skill_templates as $skill) {
                $html .= '<p><span class="skill_name">';
                $html .= ucwords($skill['name']) . '</span> <span>(' . $skill['key_ability'] . '): </span>';
                $html .= '<input name="' . $skill['label'] . '_skill_mod" type="number"> = ';
                $html .= '<input name="' . $skill['label'] . '_ability_mod" type="number"> + ';
                $html .= '<input name="' . $skill['label'] . '_ranks" type="number"> + ';
                $html .= '<input name="' . $skill['label']. '_misc_mod" type="number">';
                $html .= '</p>' . "\n";
                $html .= '<p class="skill_description">' . $skill['description'] . '</p>' . "\n";
            }

            $html .= '</div> <!-- end #skills_creation -->' . "\n";

            return $html;
        }

        public function buildFeatsInputs() {
            $html = '';

            $html .= '<div id="feats_creation">' . "\n";
            $html .= '<h4>Feats: </h4>' . "\n";
            $html .= '<p>some feat\'s search function here</p>';
            $html .= '</div> <!-- end #feats_creation -->' . "\n";

            return $html;
        }

        public function buildSpecialAbilitiesInputs() {
            $html = '';

            $html .= '<div id="special_abilities_creation">' . "\n";
            $html .= '<h4>Special Abilities: </h4>' . "\n";
            $html .= '<p>some special abilities\' search function here</p>';
            $html .= '</div> <!-- end #special_abilities_creation -->' . "\n";

            return $html;
        }

    }

}