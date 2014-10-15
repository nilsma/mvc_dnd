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
            if(isset($_SESSION['creation_array'])) {
                $creation_array = $_SESSION['creation_array'];
            } else {
                $creation_array = $_POST;
            }

            $html = '';

            $html .= '<div id="character_creation">' . "\n";
            $html .= '<form name="create_character" action="' . $_SERVER['PHP_SELF'] . '" method="POST">' . "\n";
            $html .= $this->buildPersonalia($creation_array);
            $html .= $this->buildStats($creation_array);
            $html .= $this->buildArmorClass($creation_array);
            $html .= $this->buildAttributes($creation_array);
            $html .= $this->buildSavingThrows($creation_array);
            $html .= $this->buildAttacks($creation_array);
            $html .= $this->buildArmors($creation_array);
            $html .= $this->buildSkills($creation_array);
            $html .= $this->buildFeats();
            $html .= $this->buildSpecialAbilities();
            $html .= $this->buildLanguages($creation_array);
            $html .= $this->buildPurse($creation_array);
            $html .= $this->buildInventory($creation_array);
            $html .= '<input name="submit" type="submit"  value="Create Character">' . "\n";
            $html .= '</form>' . "\n";
            $html .= '</div> <!-- end #character_creation -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheets personalia segment creation
         * @return string - the HTML representation of the personalia creation segment
         */
        public function buildPersonalia($creation_array) {
            $prefix = 'personalia_';
            $categories = array('name' => 'Name', 'class' => 'Class', 'level' => 'Level', 'size' => 'Size',
                'age' => 'Age', 'gender' => 'Gender', 'height' => 'Height', 'weight' => 'Weight', 'eyes' => 'Eyes',
                'hair' => 'Hair', 'skin' => 'Skin', 'race' => 'Race', 'alignment' => 'Alignment',
                'deity' => 'Deity', 'xp' => 'XP', 'next_level' => 'Next Level'
            );

            $html = '';
            $html .= '<div id="personalia">' . "\n";
            $html .= '<h2>Personalia</h2>' . "\n";

            foreach($categories as $key => $val) {
                if(isset($creation_array[$prefix . $key])) {
                    $value = $creation_array[$prefix . $key];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $val . ': <input name="' . $prefix . $key . '" type="text" maxlength="50" value="' . $value . '"></label>' . "\n";
            }

            $html .= '</div> <!-- end #personalia -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's stats segment creation
         * @return string - the HTML representation of the stats creation segment
         */
        public function buildStats($creation_array) {
            $categories = array('stats_hp', 'stats_wounds', 'stats_non_lethal', 'stats_initiative_mod',
                'stats_spell_resistance', 'stats_speed', 'stats_damage_reduction'
            );

            $vals = array();

            foreach($categories as $category) {
                if(isset($creation_array[$category])) {
                    $vals[$category] = $creation_array[$category];
                } else {
                    $vals[$category] = '';
                }
            }

            $html = '';

            $html .= '<div id="stats">' . "\n";
            $html .= '<h2>Stats</h2>' . "\n";
            $html .= '<label>HP: <input name="stats_hp" type="number" value="' . $vals['stats_hp'] . '"></label>' . "\n";
            $html .= '<label>Wounds: <input name="stats_wounds" type="number" value="' . $vals['stats_wounds'] . '"></label>' . "\n";
            $html .= '<label>Non Lethal: <input name="stats_non_lethal" type="number" value="' . $vals['stats_non_lethal'] . '"></label>' . "\n";
            $html .= '<label>Initiative Modifier: <input name="stats_initiative_mod" type="number" value="' . $vals['stats_initiative_mod'] . '"></label>' . "\n";
            $html .= '<label>Spell Resistance: <input name="stats_spell_resistance" type="number" value="' . $vals['stats_spell_resistance'] . '"></label>' . "\n";
            $html .= '<label>Speed: <input name="stats_speed" type="number" value="' . $vals['stats_speed'] . '"></label>' . "\n";
            $html .= '<label>Damage Reduction: <input name="stats_damage_reduction" type="number" value="' . $vals['stats_damage_reduction'] . '"></label>' . "\n";
            $html .= '</div> <!-- end #stats -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's attributes creation segment
         * @return string - the HTML represantation of the attributes creation segment
         */
        public function buildAttributes($creation_array) {
            $html = '';

            $html .= '<div id="attributes">' . "\n";
            $html .= '<h2>Attributes</h2>' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '<td>Ability Score</td>' . "\n";
            $html .= '<td>Ability Modifier</td>' . "\n";
            $html .= '<td>Temp Score</td>' . "\n";
            $html .= '<td>Temp Modifier</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";

            $attributes = array('strength', 'constitution', 'dexterity', 'intelligence', 'wisdom', 'charisma');

            foreach($attributes as $attribute) {
                $vals = array();

                $html .= '<tr>' . "\n";
                $html .= '<td>' . ucfirst($attribute) . ': </td>' . "\n";

                $categories = array($attribute . '_score', $attribute . '_mod', $attribute . '_temp_score',
                    $attribute . '_temp_mod'
                );

                foreach($categories as $category) {
                    if(isset($creation_array[$category])) {
                        $vals[$category] = $creation_array[$category];
                    } else {
                        $vals[$category] = '';
                    }

                    $html .= '<td><input name="' . $category . '" type="number" min="0" value="' . $vals[$category] . '"></td>' . "\n";
                }

                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end attbributes -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's armor class creation segment
         * @return string - the HTML represantation of the armor class creation segment
         */
        public function buildArmorClass($creation_array) {
            $categories = array('Total' => 'ac_total', 'AC Base' => 'ac_base', 'Armor Bonus' => 'ac_armor_bonus',
                'Shield Bonus' => 'ac_shield_bonus', 'Dex Modifier' => 'ac_dex_mod',
                'Size Modifier' => 'ac_size_mod', 'Natural Armor' => 'ac_natural_armor',
                'Touch AC' => 'ac_touch_ac', 'Flat Footed AC' => 'ac_flat_footed_ac'
            );

            $html = '';

            $html .= '<div id="armor_class">' . "\n";
            $html .= '<h2>Armor Class</h2>' . "\n";

            foreach($categories as $key => $val) {
                $value = NULL;
                if(isset($creation_array[$val])) {
                    $value = $creation_array[$val];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $key . ': <input name="' . $val . '" type="number" min="0" value="' . $value . '"></label>' . "\n";
            }

            $html .= '</div> <!-- end #armor_class -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's attacks creation segment
         * @return string - the HTML represantation of the attacks creation segment
         */
        public function buildAttacks($creation_array) {
            $categories = array('Base Attack Bonus' => 'attacks_base_attack_bonus',
                'Attacks Per Round' => 'attacks_attacks_per_round');

            $html = '';

            $html .= '<div id="attacks">' . "\n";
            $html .= '<h2>Attacks</h2>' . "\n";

            foreach($categories as $key => $val) {
                $value = NULL;
                if(isset($creation_array[$val])) {
                    $value = $creation_array[$val];
                } else {
                    $value = '';
                }
                $html .= '<label>' . $key . ': <input name="' . $val . '" type="text" maxlength="25" value="' . $value . '"></label>' . "\n";
            }

            $html .= $this->buildGrapple($creation_array);
            $html .= $this->buildAttack($creation_array);
            $html .= '<input name="add_attack" type="submit" value="Add Attack">' . "\n";
            $html .= '<input name="remove_attack" type="submit" value="Remove Last Attack">' . "\n";

            $html .= '</div> <!-- end #attacks -->' . "\n";

            return $html;
        }

        /**
         * A method to build the character sheet's grapple creation segment
         * @return string - the HTML represantation of the grapple creation segment
         */
        public function buildGrapple($creation_array) {
            $categories = array('Total' => 'grapple_total', 'Base Attack Bonus' => 'grapple_base_attack_bonus',
                'Strength Modifier' => 'grapple_str_mod', 'Size Modifier' => 'grapple_size_mod',
                'Misc Modifier' => 'grapple_misc_mod');

            $html = '';

            $html .= '<div id="grapple">' . "\n";
            $html .= '<h3>Grapple</h3>' . "\n";

            foreach($categories as $key => $val) {
                if(isset($creation_array[$val])) {
                    $value = $creation_array[$val];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $key . ': <input name="' . $val . '" type="number" value="' . $value . '"></label>' . "\n";
            }

            $html .= '</div> <!-- end #grapple -->' . "\n";
            return $html;
        }

        /**
         * A method to build the character sheet's attack creation segment
         * @return string - the HTML represantation of the attack creation segment
         */
        public function buildAttack($creation_array) {
            $categories = array('Name' => 'attack_name', 'Attack Bonus' => 'attack_attack_bonus',
                'Damage' => 'attack_damage', 'Critical Floor' => 'attack_critical_floor',
                'Critical Ceiling' => 'attack_critical_ceiling', 'Weapong Range' => 'attack_weapon_range',
                'Type' => 'attack_type', 'Notes' => 'attack_notes', 'Ammunition' => 'attack_ammunition');

            $html = '';

            $html .= '<div class="attack">' . "\n";

            for($i = 1; $i < $_SESSION['no_of_attacks'] + 1; $i++) {

                $html .= '<h3>Attack ' . $i . '</h3>' . "\n";

                foreach($categories as $key => $val) {
                    if(isset($creation_array[$val . '_' . $i])) {
                        $value = $creation_array[$val . '_' . $i];
                    } else {
                        $value = '';
                    }

                    $html .= '<label>' . $key . ': <input name="' . $val . '_' . $i . '" type="text" maxlength="50" value="' . $value . '"></label>' . "\n";
                }
            }

            $html .= '</div> <!-- end .attack -->' . "\n";
            return $html;
        }

        /**
         * A method to build the character sheet's skills creation segment
         * @return string - the HTML represantation of the skills creation segment
         */
        public function buildSkills($creation_array) {
            $categories = array('skills_max_ranks_class' => 'Max Ranks Class',
                'skills_max_ranks_cross_class' => 'Max Ranks Cross Class'
            );

            $html = '';

            $templates_array = $this->model->getSkillsTemplates();

            $html .= '<div id="skills">' . "\n";
            $html .= '<h2>Skills</h2>' . "\n";

            foreach($categories as $key => $val) {
                if(isset($creation_array[$key])) {
                    $value = $creation_array[$key];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $val . ': <input name="' . $key . '" type="number" value="' . $value . '"></label>' . "\n";
            }

            $html .= '<div id="skill">' . "\n";

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

            $template_categories = array('skill_mod' => 'Skill Modifier', 'ability_mod' => 'Ability Modifier',
                'ranks' => 'Ranks', 'misc_mod' => 'Misc Mod'
            );

            foreach($templates_array as $template) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label>' . $template['common_name']. ': </label></td>' . "\n";
                $html .= '<td>(' . strtoupper($template['key_ability']) . ')</td>' . "\n";

                foreach($template_categories as $key => $val) {
                    $key_post_name = 'skill_' . $template['template_name'] . '_' . $key;
                    if(isset($creation_array[$key_post_name])) {
                        $value = $creation_array[$key_post_name];
                    } else {
                        $value = '';
                    }

                    $html .= '<td><input name="' . $key_post_name . '" type="number" value="' . $value . '"></td>' . "\n";
                }

                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #skill -->' . "\n";
            $html .= '</div> <!-- end #skills-->' . "\n";

            return $html;

        }
        
        public function buildPurse($creation_array) {
            $currencies = $_SESSION['currencies_array'];

            $html = '';
            $html .= '<div id="purse">' . "\n";
            $html .= '<h2>Purse</h2>' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td>Currency</td>' . "\n";
            $html .= '<td>Amount</td>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";
            $html .= '<tbody>' . "\n";

            if(count($currencies) < 1) {
                $html .= '<p>You haven\'t added any currencies yet.</p>' . "\n";
            } else {
                foreach($currencies as $currency) {
                    $label = $currency['label'];
                    $name = $currency['name'];
                    $amount = $currency['amount'];

                    if(isset($creation_array[$label])) {
                        $value = $creation_array[$label];
                    } else {
                        $value = $amount;
                    }

                    $html .= '<tr>' . "\n";
                    $html .= '<td><label>' . ucfirst($name) . '</label>: </td>' . "\n";
                    $html .= '<td><input name="' . $label . '" type="number" value="' . $value . '"></td>' . "\n";
                    $html .= '<td><a class="remove_currency" href="javascript:void()">remove</a></td>' . "\n";
                    $html .= '</tr>' . "\n";
                }
            }

            $html .= '</tbody>' . "\n";
            $html .= '</table>' . "\n";

            $html .= '<input name="add_currency" type="submit" value="Add Currency">' . "\n";
            $html .= '<input name="new_currency" type="text" maxlength="50" value="">' . "\n";

            $html .= '</div> <!-- end #purse -->' . "\n";
            
            return $html;
        }

        public function buildLanguages($creation_array) {
            $languages = $_SESSION['languages_array'];

            if(isset($creation_array['max_number_of_languages'])) {
                $max_number_of_languages = $creation_array['max_number_of_languages'];
            } else {
                $max_number_of_languages = 0;
            }

            $html = '';

            $html .= '<div id="languages">' . "\n";
            $html .= '<h2>Languages</h2>' . "\n";
            $html .= '<label>Max number of languages: <input name="max_number_of_languages" type="number" value="' . $max_number_of_languages . '"></label>' . "\n";

            if(count($languages) < 1) {
                $html .= '<p>You haven\'t added any languages yet.</p>' . "\n";
            } else {
                $html .= '<ul>' . "\n";

                foreach($languages as $language) {
                    $html .= '<li><span>' . ucwords($language) . '</span> <a class="remove_language" href="javascript:void()">remove</a></li>' . "\n";
                }

                $html .= '</ul>' . "\n";
            }

            $html .= '<input name="add_language" type="submit" value="Add Language">' . "\n";
            $html .= '<input name="new_language" type="text" maxlength="30" value="">' . "\n";

            $html .= '</div> <!-- end #languages -->' . "\n";

            return $html;
        }

        public function buildSpecialAbilities() {
            $special_abilities_array = array();

            if(isset($_SESSION['special_abilities_array'])) {
                $special_abilities_array = $_SESSION['special_abilities_array'];
            }

            $html = '';

            $html .= '<div id="special_abilities">' . "\n";
            $html .= '<h2>Special Abilities</h2>' . "\n";

            $html .= '<div id="special_ability_search">' . "\n";
            $html .= '<label for="special_ability_search_input">Add Special Ability: </label>' . "\n";
            $html .= '<input class="special_ability_search_input" id="special_ability_search_input" name="special_ability_search_input" type="text" value="">' . "\n";
            $html .= '<input class="special_ability_search_template" id="special_ability_search_template" name="special_ability_search_template" type="text" value="" hidden>' . "\n";
            $html .= '<input name="add_special_ability" type="submit" value="Add">' . "\n";

            $html .= '</div> <!-- end #special_ability_search -->' . "\n";

            $html .= '<div id="special_abilities_suggestions_box">' . "\n";
            $html .= '</div> <!-- end #special_abilities_suggestions_box -->' . "\n";

            if(!isset($special_abilities_array) || $special_abilities_array < 1) {
                $html .= '<p>You havent added any Special Abilites yet!</p>' . "\n";
            } else {

                $html .= '<ul>' . "\n";

                foreach($special_abilities_array as $key => $val) {
                    $html .= '<li><span>' . $val . '</span> <span><a class="gui special_ability_template_info" href="javascript:void()">info</a></span> ';
                    $html .= ' <span><a class="gui remove_special_ability" href="javascript:void()">remove</a></span></li>' . "\n";
                }

                $html .= '</ul>' . "\n";

                $html .= '<div id="special_ability_template_info">' . "\n";
                $html .= '</div> <!-- end #special_ability_template_info -->' . "\n";
            }

            $html .= '</div> <!-- end #special_abilities -->' . "\n";

            return $html;
        }

        public function buildFeats() {
            $feats_array = array();

            if(isset($_SESSION['feats_array'])) {
                $feats_array = $_SESSION['feats_array'];
            }

            $html = '';

            $html .= '<div id="feats">' . "\n";
            $html .= '<h2>Feats</h2>' . "\n";

            $html .= '<div id="feats_search">' . "\n";
            $html .= '<label>Add Feat: </label>' . "\n";
            $html .= '<input id="feats_search_input" name="feats_search_input" type="text" value="">' . "\n";
            $html .= '<input id="feats_search_template" name="feats_search_template" type="text" value="" hidden>' . "\n";
            $html .= '<input name="add_feat" type="submit" value="Add">' . "\n";

            $html .= '</div> <!-- end #feats_search -->' . "\n";

            $html .= '<div id="feats_suggestions_box">' . "\n";
            $html .= '</div> <!-- end #feats_suggestions_box -->' . "\n";

            if(!isset($feats_array) || $feats_array < 1) {
                $html .= '<p>You havent added any Feats yet!</p>' . "\n";
            } else {

                $html .= '<ul>' . "\n";

                foreach($feats_array as $key => $val) {
                    $html .= '<li><span>' . $val . '</span> <span><a class="gui feat_template_info" href="javascript:void()">info</a></span> ';
                    $html .= ' <span><a class="gui remove_feat" href="javascript:void()">remove</a></span></li>' . "\n";
                }

                $html .= '</ul>' . "\n";

                $html .= '<div id="feat_template_info">' . "\n";
                $html .= '</div> <!-- end #feat_template_info -->' . "\n";
            }

            $html .= '</div> <!-- end #feats -->' . "\n";

            return $html;
        }

        public function buildInventory($creation_array) {
            $categories = array('light_load' => 'Light Load', 'medium_load' => 'Medium Load',
                'heavy_load' => 'Heavy Load', 'lift_over_head' => 'Lift Over Head',
                'lift_off_ground' => 'Lift Off Ground', 'push_or_drag' => 'Push Or Drag'
            );

            $html = '';

            $html .= '<div id="inventory">' . "\n";
            $html .= '<h2>Inventory</h2>' . "\n";

            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td>Item Name</td>' . "\n";
            $html .= '<td>Quantity</td>' . "\n";
            $html .= '<td>Weight (kg)</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";

            $no_of_items = $_SESSION['no_of_inventory_items'];
            for($x = 1; $x <= $no_of_items; $x++) {
                $name = 'item_name_' . $x;
                $quantity = 'item_quantity_' . $x;
                $weight = 'item_weight_' . $x;

                if(isset($creation_array[$name])) {
                    $name_value = $creation_array[$name];
                } else {
                    $name_value = '';
                }

                if(isset($creation_array[$quantity])) {
                    $quantity_value = $creation_array[$quantity];
                } else {
                    $quantity_value = '';
                }

                if(isset($creation_array[$weight])) {
                    $weight_value = $creation_array[$weight];
                } else {
                    $weight_value = '';
                }

                $html .= '<tr>' . "\n";
                $html .= '<td><input name="' . $name . '" type="text" value="' . $name_value . '"></td>' . "\n";
                $html .= '<td><input name="' . $quantity . '" type="number" value="' . $quantity_value . '"></td>' . "\n";
                $html .= '<td><input name="' . $weight . '" type="number" step="0.01" value="' . $weight_value . '"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";

            $html .= '<input name="add_item" type="submit" value="Add More Space">' . "\n";
            $html .= '<input name="remove_item" type="submit" value="Remove Last Slot">' . "\n";

            $html .= '<div>' . "\n";

            foreach($categories as $key => $val) {
                if(isset($creation_array['inventory_' . $key])) {
                    $value = $creation_array['inventory_' . $key];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $val . ': <input name="inventory_' . $key . '" type="number" min="0" value="' . $value . '"></label>' . "\n";
            }

            $html .= '</div>' . "\n";

            $html .= '</div> <!-- end #inventory -->' . "\n";

            return $html;
        }

        public function buildSavingThrows($creation_array) {
            $saving_throws = array(
                'fortitude' => 'con',
                'reflex' => 'dex',
                'will' => 'wis'
            );

            $html = '';

            $html .= '<div id="saving_throws">' . "\n";
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

            foreach($saving_throws as $key => $val) {
                $html .= '<tr>' . "\n";
                $html .= '<td><label for="saving_throw_' . $key . '_total">' . ucfirst($key) . ' (' . strtoupper($val) . '): </label></td>' . "\n";

                $categories = array('total', 'base_save', 'ability_mod', 'magic_mod', 'misc_mod', 'temp_mod');

                foreach($categories as $category) {
                    $label = 'saving_throw_' . $key . '_' . $category;
                    if(isset($creation_array[$label])) {
                        $value = $creation_array[$label];
                    } else {
                        $value = '';
                    }
                    $html .= '<td><input id="' . $label . '" name="' . $label . '" type="number" min="0" value="' . $value . '"></td>' . "\n";
                }

                $html .= '</tr>' . "\n";
            }

            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #saving_throws -->' . "\n";

            return $html;
        }

        public function buildArmors($creation_array) {
            $html = '';

            $html .= '<div id="armors">' . "\n";
            $html .= '<h2>Armors</h2>' . "\n";
            $html .= $this->buildArmor($creation_array);
            $html .= $this->buildShield($creation_array);
            $html .= $this->buildProtectiveItems($creation_array);
            $html .= '<input name="add_protective_item" type="submit" value="Add Protective Item">' . "\n";
            $html .= '<input name="remove_protective_item" type="submit" value="Remove Last Protective Item">' . "\n";
            $html .= '</div> <!-- end #armors -->' . "\n";

            return $html;
        }

        public function buildArmor($creation_array) {
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
            foreach($armor_segments as $key => $val) {
                if(isset($creation_array[$key])) {
                    $value = $creation_array[$key];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $val . ': <input name="' . $key . '" type="text" value="' . $value . '"></label>' . "\n";
            }

            return $html;
        }

        public function buildShield($creation_array) {
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

            foreach($shield_segments as $key => $val) {
                if(isset($creation_array[$key])) {
                    $value = $creation_array[$key];
                } else {
                    $value = '';
                }

                $html .= '<label>' . $val . ': <input name="' . $key . '" type="text" value="' . $value . '"></label>' . "\n";
            }

            return $html;
        }

        public function buildProtectiveItems($creation_array) {
            $protective_item_segments = array(
                'protective_item_name' => 'Name',
                'protective_item_ac_bonus' => 'AC Bonus',
                'protective_item_weight' => 'Weight',
                'protective_item_special_properties' => 'Special Properties'
            );

            $html = '';

            for($i = 1; $i < $_SESSION['no_of_protective_items'] + 1; $i++) {
                $html .= '<h3>Protective Item ' . $i . '</h3>' . "\n";

                foreach($protective_item_segments as $key => $val) {
                    if(isset($creation_array[$key . '_' . $i])) {
                        $value = $creation_array[$key . '_' . $i];
                    } else {
                        $value = '';
                    }

                    $html .= '<label>' . $val . ': <input name="' . $key . '_' . $i . '" type="text" value="' . $value . '"></label>' . "\n";
                }

            }

            return $html;
        }

    }

}