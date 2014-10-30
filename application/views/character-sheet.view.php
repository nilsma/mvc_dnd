<?php
/**
 * A view class file for the create-character page
 */
if(!class_exists('Character_Sheet_View')) {

    class Character_Sheet_view extends Base_View {

        protected $page_id;

        public function __construct($model, $controller, $title, $page_id) {
            $this->page_id = $page_id;

            parent::__construct($model, $controller, $title, $page_id);
        }

        /**
         * A function to render the view
         */
        public function render($character_sheet) {
            include '../application/templates/head.html';

            $html = '' . "\n";
            $html .= $this->buildHeader($this->page_id);
            $html .= '<h1>Character Sheet</h1>' . "\n";
            $html .= '<form name="sheet" method="POST" action="' . $_SERVER['PHP_SELF'] . '">' . "\n";
            $html .= $this->buildCharacter($character_sheet);
            $html .= '</form>' . "\n";

            echo $html;

            include '../application/templates/footer.html';
        }

        public function buildCharacter($character_sheet) {
            $html = '';

            $html .= $this->buildPersonalia($character_sheet->getPersonalia());
            $html .= $this->buildStats($character_sheet->getStats());
            $html .= $this->buildArmorClass($character_sheet->getArmorClass());
            $html .= $this->buildAttributes($character_sheet->getAttributes());
            $html .= $this->buildSavingThrows($character_sheet->getSavingThrows());
            $html .= $this->buildAttacks($character_sheet->getAttacks());
            $html .= $this->buildGrapple($character_sheet->getGrapple());
            $html .= $this->buildArmors($character_sheet->getArmors());
            $html .= $this->buildSkills($character_sheet->getSkills());
            $html .= $this->buildFeats($character_sheet->getFeats());
            $html .= $this->buildSpecialAbilities($character_sheet->getSpecialAbilities());
            $html .= $this->buildLanguages($character_sheet->getLanguages());
            $html .= $this->buildCurrencies($character_sheet->getCurrencies());
            $html .= $this->buildInventory($character_sheet->getInventory());

            return $html;
        }

        public function buildPersonalia(Personalia $personalia) {
            $html = '';

            $html .= '<div id="personalia">' . "\n";
            $html .= '<h2>Personalia</h2>' . "\n";
            $html .= '<label for="personalia_name">Name: </label>';
            $html .= '<input class="personalia_input" id="personalia_name" name="personalia_name" type="text" maxlength="50" value="' . $personalia->getName() . '">' . "\n";
            $html .= '<label for="personalia_class">Class: </label>';
            $html .= '<input class="personalia_input" id="personalia_class" name="personalia_class" type="text" maxlength="50" value="' . $personalia->getClass() . '">' . "\n";
            $html .= '<label for="personalia_level">Level: </label>';
            $html .= '<input class="personalia_input" id="personalia_level" name="personalia_level" type="number" value="' . $personalia->getLevel() . '">' . "\n";
            $html .= '<label for="personalia_size">Size: </label>';
            $html .= '<input class="personalia_input" id="personalia_size" name="personalia_size" type="text" maxlength="10" value="' . $personalia->getSize() . '">' . "\n";
            $html .= '<label for="personalia_age">Age: </label>';
            $html .= '<input class="personalia_input" id="personalia_age" name="personalia_age" type="number" value="' . $personalia->getAge() . '">' . "\n";
            $html .= '<label for="personalia_gender">Gender: </label>';
            $html .= '<input class="personalia_input" id="personalia_gender" name="personalia_gender" type="text" maxlength="30" value="' . $personalia->getGender() . '">' . "\n";
            $html .= '<label for="personalia_height">Height: </label>';
            $html .= '<input class="personalia_input" id="personalia_height" name="personalia_height" type="number" value="' . $personalia->getHeight() . '">' . "\n";
            $html .= '<label for="personalia_weight">Weight: </label>';
            $html .= '<input class="personalia_input" id="personalia_weight" name="personalia_weight" type="number" value="' . $personalia->getWeight() . '">' . "\n";
            $html .= '<label for="personalia_eyes">Eyes: </label>';
            $html .= '<input class="personalia_input" id="personalia_eyes" name="personalia_eyes" type="text" maxlength="30" value="' . $personalia->getEyes() . '">' . "\n";
            $html .= '<label for="personalia_hair">Hair: </label>';
            $html .= '<input class="personalia_input" id="personalia_hair" name="personalia_hair" type="text" maxlength="30" value="' . $personalia->getHair() . '">' . "\n";
            $html .= '<label for="personalia_skin">Skin: </label>';
            $html .= '<input class="personalia_input" id="personalia_skin" name="personalia_skin" type="text" maxlength="30" value="' . $personalia->getSkin() . '">' . "\n";
            $html .= '<label for="personalia_race">Race: </label>';
            $html .= '<input class="personalia_input" id="personalia_race" name="personalia_race" type="text" maxlength="30" value="' . $personalia->getRace() . '">' . "\n";
            $html .= '<label for="personalia_alignment">Alignment: </label>';
            $html .= '<input class="personalia_input" id="personalia_alignment" name="personalia_alignment" type="text" maxlength="30" value="' . $personalia->getAlignment() . '">' . "\n";
            $html .= '<label for="personalia_deity">Deity: </label>';
            $html .= '<input class="personalia_input" id="personalia_deity" name="personalia_deity" type="text" maxlength="30" value="' . $personalia->getDeity() . '">' . "\n";
            $html .= '<label for="personalia_xp">XP: </label>';
            $html .= '<input class="personalia_input" id="personalia_xp" name="personalia_xp" type="number" value="' . $personalia->getXp() . '">' . "\n";
            $html .= '<label for="personalia_next_level">Next Level: </label>';
            $html .= '<input class="personalia_input" id="personalia_next_level" name="personalia_next_level" type="number" value="' . $personalia->getNextLevel() . '">' . "\n";
            $html .= '</div> <!-- end #personalia -->' . "\n";

            return $html;
        }

        public function buildStats(Stats $stats) {
            $html = '';

            $html .= '<div id="stats">' . "\n";
            $html .= '<h2>Stats</h2>' . "\n";
            $html .= '<label for="stats_hp">HP: </label>';
            $html .= '<input class="stats_input" id="stats_hp" name="stats_hp" type="number" value="' . $stats->getHp() . '">' . "\n";
            $html .= '<label for="stats_wounds">Wounds: </label>';
            $html .= '<input class="stats_input" id="stats_wounds" name="stats_wounds" type="number" value="' . $stats->getWounds() . '">' . "\n";
            $html .= '<label for="stats_non_lethal">Non Lethal: </label>';
            $html .= '<input class="stats_input" id="stats_non_lethal" name="stats_non_lethal" type="number" value="' . $stats->getNonLethal() . '">' . "\n";
            $html .= '<label for="stats_initiative_mod">Initiative Mod: </label>';
            $html .= '<input class="stats_input" id="stats_initiative_mod" name="stats_initiative_mod" type="number" value="' . $stats->getInitiativeMod() . '">' . "\n";
            $html .= '<label for="stats_spell_resistance">Spell Resistance: </label>';
            $html .= '<input class="stats_input" id="stats_spell_resistance" name="stats_spell_resistance" type="number" value="' . $stats->getSpellResistance() . '">' . "\n";
            $html .= '<label for="stats_speed">Speed: </label>';
            $html .= '<input class="stats_input" id="stats_speed" name="stats_speed" type="number" value="' . $stats->getSpeed() . '">' . "\n";
            $html .= '<label for="stats_damage_reduction">Damage Reduction: </label>';
            $html .= '<input class="stats_input" id="stats_damage_reduction" name="stats_damage_reduction" type="number" value="' . $stats->getDamageReduction() . '">' . "\n";

            $html .= '</div> <!-- end #stats -->' . "\n";

            return $html;

        }
        
        public function buildArmorClass($armor_class) {
            $html = '';
            
            $html .= '<div id="armor_class">' . "\n";
            $html .= '<h3>Armor Class</h3>' . "\n";
            $html .= '<label for="armor_class_total">Armor Class: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_total" name="armor_class_total" type="number" value="' . $armor_class->getAcTotal() . '">' . "\n";
            $html .= '<label for="armor_class_base">Base: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_base" name="armor_class_base" type="number" value="' . $armor_class->getAcBase() . '">' . "\n";
            $html .= '<label for="armor_class_armor_bonus">Armor Bonus: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_armor_bonus" name="armor_class_armor_bonus" type="number" value="' . $armor_class->getAcArmorBonus() . '">' . "\n";
            $html .= '<label for="armor_class_shield_bonus">Shield Bonus: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_shield_bonus" name="armor_class_shield_bonus" type="number" value="' . $armor_class->getAcShieldBonus() . '">' . "\n";
            $html .= '<label for="armor_class_dex_mod">Dex Mod: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_dex_mod" name="armor_class_dex_mod" type="number" value="' . $armor_class->getAcDexMod() . '">' . "\n";
            $html .= '<label for="armor_class_size_mod">Size Mod: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_size_mod" name="armor_class_size_mod" type="number" value="' . $armor_class->getAcSizeMod() . '">' . "\n";
            $html .= '<label for="armor_class_natural_armor">Natural Armor: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_natural_armor" name="armor_class_natural_armor" type="number" value="' . $armor_class->getAcNaturalArmor() . '">' . "\n";
            $html .= '<label for="armor_class_touch_ac">Touch AC: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_touch_ac" name="armor_class_touch_ac" type="number" value="' . $armor_class->getAcTouchAc() . '">' . "\n";
            $html .= '<label for="armor_class_flat_footed_ac">Flat Footed AC: </label>';
            $html .= '<input class="armor_class_input" id="armor_class_flat_footed_ac" name="armor_class_flat_footed_ac" type="number" value="' . $armor_class->getAcFlatFootedAc() . '">' . "\n";
            $html .= '</div> <!-- end #armor_class -->' . "\n";
            
            return $html;
        }

        public function buildAttributes(Array $attributes) {
            $html = '';

            $html .= '<div id="attributes">' . "\n";
            $html .= '<h2>Attributes</h2>' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '<td>Ability Score</td>';
            $html .= '<td>Ability Mod</td>';
            $html .= '<td>Temp Score</td>';
            $html .= '<td>Temp Mod</td>';
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";
            $html .= '<tbody>' . "\n";

            $ordered = Utils::orderAttributesArray($attributes);

            foreach($ordered as $attribute) {
                $name = ucfirst($attribute->getName());
                $label = strtolower($name);
                $ability_score = $attribute->getAbilityScore();
                $ability_mod = $attribute->getAbilityMod();
                $temp_score = $attribute->getTempScore();
                $temp_mod = $attribute->getTempMod();

                $html .= '<tr>' . "\n";
                $html .= '<td>' . $name. '</td>' . "\n";
                $html .= '<td><input class="attribute_input" id="' . $label . '_ability_score" type="number" value="' . $ability_score . '"></td>' . "\n";
                $html .= '<td><input class="attribute_input" id="' . $label . '_ability_mod" type="number" value="' . $ability_mod . '"></td>' . "\n";
                $html .= '<td><input class="attribute_input" id="' . $label . '_temp_score" type="number" value="' . $temp_score . '"></td>' . "\n";
                $html .= '<td><input class="attribute_input" id="' . $label . '_temp_mod" type="number" value="' . $temp_mod . '"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</tbody>' . "\n";
            $html .= '</table>' . "\n";

            return $html;
        }

        public function buildSavingThrows($saving_throws) {
            $html = '';

            $html .= '<div id="saving_throws">' . "\n";
            $html .= '<h2>Saving Throws</h2>' . "\n";

            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '<td></td>' . "\n";
            $html .= '<td>Total</td>' . "\n";
            $html .= '<td>Base Save</td>'. "\n";
            $html .= '<td>Ability Mod</td>' . "\n";
            $html .= '<td>Magic Mod</td>' . "\n";
            $html .= '<td>Misc Mod</td>'. "\n";
            $html .= '<td>Temp Mod</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";

            $html .= '<tbody>' . "\n";

            foreach($saving_throws as $saving_throw) {
                $name = ucwords($saving_throw->getName());
                $label = strtolower($name);
                $key_ability = $saving_throw->getKeyAbility();
                $total = $saving_throw->getTotal();
                $base_save = $saving_throw->getBaseSave();
                $ability_mod = $saving_throw->getAbilityMod();
                $magic_mod = $saving_throw->getMagicMod();
                $misc_mod = $saving_throw->getMiscMod();
                $temp_mod = $saving_throw->getTempMod();

                $html .= '<tr>' . "\n";
                $html .= '<td>' . $name . '</td>' . "\n";
                $html .= '<td>(' . strtoupper(substr($key_ability, 0, 3)) . ')</td>' . "\n";
                $html .= '<td><input class="saving_throw_input" id="' . $label . '_total" type="number" value="' . $total . '"></td>' . "\n";
                $html .= '<td><input class="saving_throw_input" id="' . $label . '_base_save" type="number" value="' . $base_save . '"></td>' . "\n";
                $html .= '<td><input class="saving_throw_input" id="' . $label . '_ability_mod" type="number" value="' . $ability_mod . '"></td>' . "\n";
                $html .= '<td><input class="saving_throw_input" id="' . $label . '_magic_mod" type="number" value="' . $magic_mod . '"></td>' . "\n";
                $html .= '<td><input class="saving_throw_input" id="' . $label . '_misc_mod" type="number" value="' . $misc_mod . '"></td>' . "\n";
                $html .= '<td><input class="saving_throw_input" id="' . $label . '_temp_mod" type="number" value="' . $temp_mod . '"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</tbody>' . "\n";
            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #saving_throws -->' . "\n";

            return $html;
        }

        public function buildAttacks($attacks) {
            $attacks_array = $attacks->getAttacksArray();

            $html = '';

            $html .= '<div id="attacks">' . "\n";
            $html .= '<h2>Attacks</h2>' . "\n";
            $html .= '<label for="base_attack_bonus">Base Attack Bonus: </label>';
            $html .= '<input class="attacks_input" id="base_attack_bonus" name="base_attack_bonus" type="text" value="' . $attacks->getBaseAttackBonus() . '">' . "\n";
            $html .= '<label for="number_of_attacks">Number Of Attacks: </label>';
            $html .= '<input class="attacks_input" id="number_of_attacks" name="number_of_attacks" type="text" value="' . $attacks->getNumberOfAttacks() . '">' . "\n";

            foreach($attacks_array as $attack) {
                $html .= $this->buildAttack($attack);
            }

            $html .= '<input name="add_attack" type="submit" value="Add New Attack">' . "\n";

            $html .= '</div> <!-- end #attacks -->' . "\n";

            return $html;
        }

        public function buildGrapple($grapple) {
            $html = '';

            $html .= '<div id="grapple">' . "\n";
            $html .= '<h3>Grapple</h3>' . "\n";
            $html .= '<label for="grapple_total">Total: </label>';
            $html .= '<input class="grapple_input" id="grapple_total" name="grapple_total" type="number" value="' . $grapple->getGrappleTotal() . '">' . "\n";
            $html .= '<label for="grapple_bab">Base Attack Bonus: </label>';
            $html .= '<input class="grapple_input" id="grapple_bab" name="grapple_bab" type="number" value="' . $grapple->getGrappleBab() . '">' . "\n";
            $html .= '<label for="grapple_str_mod">Strength Modifier: </label>';
            $html .= '<input class="grapple_input" id="grapple_str_mod" name="grapple_str_mod" type="number" value="' . $grapple->getGrappleStrMod() . '">' . "\n";
            $html .= '<label for="grapple_size_mod">Size Modifier: </label>';
            $html .= '<input class="grapple_input" id="grapple_size_mod" name="grapple_size_mod" type="number" value="' . $grapple->getGrappleSizeMod() . '">' . "\n";
            $html .= '<label for="grapple_misc_mod">Misc Modifier: </label>';
            $html .= '<input class="grapple_input" id="grapple_misc_mod" name="grapple_misc_mod" type="number" value="' . $grapple->getGrappleMiscMod() . '">' . "\n";
            $html .= '</div> <!-- end #grapple -->' . "\n";

            return $html;
        }

        public function buildAttack(Attack $attack) {
            $html = '';

            $html .= '<div class="attack">' . "\n";
            $html .= '<input name="attack_id" type="number" value="' . $attack->getId() . '" hidden>' . "\n";
            $html .= '<label>Attack Name: </label>';
            $html .= '<input class="attack_input" name="attack_name" type="text" maxlength="50" value="' . $attack->getName() . '">' . "\n";
            $html .= '<label>Attack Bonus: </label>';
            $html .= '<input class="attack_input" name="attack_base_attack_bonus" type="text" value="' . $attack->getAttackBonus() .'">' . "\n";
            $html .= '<label for="attack_damage">Damage: </label>';
            $html .= '<input class="attack_input" name="attack_damage" type="text" maxlength="20" value="' . $attack->getDamage() .'">' . "\n";
            $html .= '<label for="attack_critical_floor">Critical: </label>';
            $html .= '<input class="attack_input" name="attack_critical_floor" type="number" value="' . $attack->getCriticalFloor() .'">' . "\n";
            $html .= '<input class="attack_input" name="attack_critical_ceiling" type="number" value="' . $attack->getCriticalCeiling() .'">' . "\n";
            $html .= '<label for="attack_weapon_range">Range: </label>';
            $html .= '<input class="attack_input" name="attack_weapon_range" type="number" value="' . $attack->getWeaponRange() .'">' . "\n";
            $html .= '<label for="attack_type">Type: </label>';
            $html .= '<input class="attack_input" name="attack_type" type="text" value="' . $attack->getType() .'">' . "\n";
            $html .= '<label for="attack_notes">Notes: </label>';
            $html .= '<input class="attack_input" name="attack_notes" notes="text" value="' . $attack->getNotes() .'">' . "\n";
            $html .= '<label for="attack_ammunition">Ammunition: </label>';
            $html .= '<input class="attack_input" name="attack_ammunition" ammunition="text" value="' . $attack->getAmmunition() .'">' . "\n";
            $html .= '<p class="gui"><a class="remove_attack" href="javascript:void()">remove</a></p>' . "\n";
            $html .= '</div> <!-- end .attack -->' . "\n";

            return $html;
        }

        public function buildSkills($skills) {
             $html = '';

            $html .= '<div id="skills">' ."\n";
            $html .= '<h2>Skills</h2>' . "\n";
            $html .= '<label for="skills_max_ranks_class">Max Ranks Class: </label>';
            $html .= '<input class="skills_input" id="skills_max_ranks_class" name="skill_max_ranks_class" type="number" value="' . $skills->getMaxRanksClass() . '">' . "\n";
            $html .= '<label for="skills_max_ranks_cross_class">Max Ranks Cross Class: </label>';
            $html .= '<input class="skills_input" id="skills_max_ranks_cross_class" name="skill_max_ranks_cross_class" type="number" value="' . $skills->getMaxRanksCrossClass() . '">' . "\n";
            $html .= $this->buildSkill($skills->getSkillArray());
            $html .= '<div id="skill_template_info">' . "\n";
            $html .= '</div> <!-- end #skill_template_info -->' . "\n";
            $html .= '</div> <!-- end #skills -->' . "\n";

            return $html;
        }

        public function buildSkill($skill_array) {
            $html = '';

            $html .= '<div id="skill">' . "\n";
            $html .= '<table>' . "\n";
            $html .= '<thead>' . "\n";
            $html .= '<tr>' . "\n";
            $html .= '<td>Skill</td>' . "\n";
            $html .= '<td>Key Ability</td>' . "\n";
            $html .= '<td>Skill Mod</td>' . "\n";
            $html .= '<td>Ability Mod</td>' . "\n";
            $html .= '<td>Ranks</td>' . "\n";
            $html .= '<td>Misc Mod</td>' . "\n";
            $html .= '</tr>' . "\n";
            $html .= '</thead>' . "\n";
            $html .= '<tbody>' . "\n";

            foreach($skill_array as $skill) {
                $template_name = $skill->getTemplateName();
                $common_name = $this->model->getSkillCommonName($template_name);
                $key_ability = $this->model->getSkillKeyAbility($template_name);

                $html .= '<tr>' . "\n";
                $html .= '<td><span><a class="gui skill_template_info" href="javascript:void()">' . $common_name . '</a></span><input name="skill_template_name" type="text" value="' . $template_name . '" hidden></td>' . "\n";
                $html .= '<td>' . strtoupper($key_ability) . '</td>' . "\n";
                $html .= '<td><input class="skill_input skill_skill_mod" type="number" value="' . $skill->getSkillMod() . '"></td>' . "\n";
                $html .= '<td><input class="skill_input skill_ability_mod" type="number" value="' . $skill->getAbilityMod() . '"></td>' . "\n";
                $html .= '<td><input class="skill_input skill_ranks" type="number" value="' . $skill->getRanks() . '"></td>' . "\n";
                $html .= '<td><input class="skill_input skill_misc_mod" type="number" value="' . $skill->getMiscMod() . '"></td>' . "\n";
                $html .= '</tr>' . "\n";
            }

            $html .= '</tbody>' . "\n";
            $html .= '</table>' . "\n";
            $html .= '</div> <!-- end #skill -->' . "\n";

            return $html;
        }

        public function buildArmors($armors) {
            $html = '';

            $html .= '<div id="armors">' . "\n";
            $html .= '<h2>Armors</h2>' . "\n";
            $html .= $this->buildArmor($armors->getArmor());
            $html .= $this->buildShield($armors->getShield());
            $html .= $this->buildProtectiveItems($armors->getProtectiveItems());
            $html .= '</div> <!-- end #armors -->' . "\n";

            return $html;
        }

        public function buildArmor(Armor $armor) {
            $html = '';

            $html .= '<div id="armor">' . "\n";
            $html .= '<h3>Armor</h3>' . "\n";
            $html .= '<label for="armor_name">Armor: </label>';
            $html .= '<input class="armor_input" id="armor_name" name="armor_name" type="text" maxlength="50" value="' . $armor->getName() . '">' . "\n";
            $html .= '<label for="armor_type">Type: </label>';
            $html .= '<input class="armor_input" id="armor_type" name="armor_type" type="text" maxlength="50" value="' . $armor->getType() . '">' . "\n";
            $html .= '<label for="armor_ac_bonus">AC Bonus: </label>';
            $html .= '<input class="armor_input" id="armor_ac_bonus" name="armor_ac_bonus" type="number" value="' . $armor->getAcBonus() . '">' . "\n";
            $html .= '<label for="armor_max_dex">Max Dex: </label>';
            $html .= '<input class="armor_input" id="armor_max_dex" name="armor_max_dex" type="number" value="' . $armor->getMaxDex() . '">' . "\n";
            $html .= '<label for="armor_check_penalty">Check Penalty: </label>';
            $html .= '<input class="armor_input" id="armor_check_penalty" name="armor_check_penalty" type="number" value="' . $armor->getCheckPenalty() . '">' . "\n";
            $html .= '<label for="armor_spell_failure">Spell Failure: </label>';
            $html .= '<input class="armor_input" id="armor_spell_failure" name="armor_spell_failure" type="number" value="' . $armor->getSpellFailure() . '">' . "\n";
            $html .= '<label for="armor_speed">Speed: </label>';
            $html .= '<input class="armor_input" id="armor_speed" name="armor_speed" type="number" value="' . $armor->getSpeed() . '">' . "\n";
            $html .= '<label for="armor_weight">Weight: </label>';
            $html .= '<input class="armor_input" id="armor_weight" name="armor_weight" type="number" value="' . $armor->getWeight() . '">' . "\n";
            $html .= '<label for="armor_special_properties">Special Properties: </label>';
            $html .= '<input class="armor_input" id="armor_special_properties" name="armor_special_properties" type="text" maxlength="200" value="' . $armor->getSpecialProperties() . '">' . "\n";
            $html .= '</div> <!-- end #armor -->' . "\n";

            return $html;
        }

        public function buildShield(Shield $shield) {
            $html = '';

            $html .= '<div id="shield">' . "\n";
            $html .= '<h3>Shield</h3>' . "\n";

            $html .= '<label for="shield_name">Shield: </label>';
            $html .= '<input class="shield_input" id="shield_name" name="shield_name" type="text" maxlength="50" value="' . $shield->getName() . '">' . "\n";
            $html .= '<label for="shield_ac_bonus">AC Bonus: </label>';
            $html .= '<input class="shield_input" id="shield_ac_bonus" name="shield_ac_bonus" type="number" value="' . $shield->getAcBonus() . '">' . "\n";
            $html .= '<label for="shield_check_penalty">Check Penalty: </label>';
            $html .= '<input class="shield_input" id="shield_check_penalty" name="shield_check_penalty" type="number" value="' . $shield->getCheckPenalty() . '">' . "\n";
            $html .= '<label for="shield_spell_failure">Spell Failure: </label>';
            $html .= '<input class="shield_input" id="shield_spell_failure" name="shield_spell_failure" type="number" value="' . $shield->getSpellFailure() . '">' . "\n";
            $html .= '<label for="shield_weight">Weight: </label>';
            $html .= '<input class="shield_input" id="shield_weight" name="shield_weight" type="number" value="' . $shield->getWeight() . '">' . "\n";
            $html .= '<label for="shield_special_properties">Special Properties: </label>';
            $html .= '<input class="shield_input" id="shield_special_properties" name="shield_special_properties" type="text" maxlength="200" value="' . $shield->getSpecialProperties() . '">' . "\n";

            $html .= '</div> <!-- end #shield -->' . "\n";

            return $html;
        }

        public function buildProtectiveItems($protective_items) {
            $html = '';

            $html .= '<div id="protective_items">' . "\n";
            $html .= '<h3>Protective Items</h3>' . "\n";

            foreach($protective_items as $protective_item) {
                $html .= $this->buildProtectiveItem($protective_item);
            }

            $html .= '<input name="add_protective_item" type="submit" value="Add New Protective Item">' . "\n";

            $html .= '</div>' . "\n";

            return $html;
        }

        public function buildProtectiveItem($protective_item) {
            $html = '';

            $html .= '<div class="protective_item">' . "\n";
            $html .= '<input class="protective_item_input" name="protective_item_id" type="number" value="' . $protective_item->getId() . '" hidden>' . "\n";
            $html .= '<label>Name: </label>';
            $html .= '<input class="protective_item_input" name="protective_item_name" type="text" maxlength="50" value="' . $protective_item->getName() . '">' . "\n";
            $html .= '<label for="protective_item_ac_bonus">AC Bonus: </label>';
            $html .= '<input class="protective_item_input" id="protective_item_ac_bonus" name="protective_item_ac_bonus" type="number" value="' . $protective_item->getAcBonus() . '">' . "\n";
            $html .= '<label for="protective_item_weight">Weight: </label>';
            $html .= '<input class="protective_item_input" id="protective_item_weight" name="protective_item_weight" type="number" value="' . $protective_item->getWeight() . '">' . "\n";
            $html .= '<label for="protective_item_special_properties">Special Properties: </label>';
            $html .= '<input class="protective_item_input" id="protective_item_special_properties" name="protective_item_special_properties" type="text" maxlength="200" value="' . $protective_item->getSpecialProperties() . '">' . "\n";
            $html .= '<p class="gui"><a class="remove_protective_item" href="javascript:void()">remove</a></p>' . "\n";

            $html .= '</div> <!-- end .protective_item -->' . "\n";

            return $html;
        }

        public function buildFeats($feats) {
            $html = '';

            $html .= '<div id="feats">' . "\n";
            $html .= '<h2>Feats</h2>' . "\n";

            $html .= '<ul>' . "\n";
            foreach($feats as $feat) {
                $common_name = $this->model->getFeatCommonName($feat->getTemplateName());
                $html .= '<li class="feat_name" id="' . $feat->getTemplateName() . '"><a class="gui feat_template_info" href="javascript:void()">' . $common_name . '</a> <a class="gui remove_feat" href="javascript:void()">remove</a></li>' . "\n";
            }
            $html .= '</ul>' . "\n";

            $html .= '<div id="feat_template_info">' . "\n";
            $html .= '</div> <!-- end #feat_template_info -->' . "\n";

            $html .= '<div id="feats_search">' . "\n";
            $html .= '<label>Add Feat: </label>' . "\n";
            $html .= '<input id="feats_search_input" name="feats_search_input" type="text" value="">' . "\n";
            $html .= '<input id="feats_search_template" name="feats_search_template" type="text" value="" hidden>' . "\n";
            $html .= '<input name="add_feat" type="submit" value="Add">' . "\n";

            $html .= '</div> <!-- end #feats_search -->' . "\n";

            $html .= '<div id="feats_suggestions_box">' . "\n";
            $html .= '</div> <!-- end #feats_suggestions_box -->' . "\n";

            $html .= '</div> <!-- end #feats -->' . "\n";

            return $html;
        }

        public function buildSpecialAbilities($special_abilities) {
            $html = '';

            $html .= '<div id="special_abilities">' . "\n";
            $html .= '<h2>Special Abilities</h2>' . "\n";

            $html .= '<ul>' . "\n";
            foreach($special_abilities as $special_ability) {
                $common_name = $this->model->getSpecialAbilityCommonName($special_ability->getTemplateName());
                $html .= '<li id="' . $special_ability->getTemplateName() . '"><a class="gui special_ability_template_info" href="javascript:void()">' . $common_name . '</a> <a class="gui remove_special_ability" href="javascript:void()">remove</a></li>' . "\n";
            }
            $html .= '</ul>' . "\n";

            $html .= '<div id="special_ability_template_info">' . "\n";
            $html .= '</div> <!-- end #special_ability_template_info -->' . "\n";

            $html .= '<div id="special_ability_search">' . "\n";
            $html .= '<label for="special_ability_search_input">Add Special Ability: </label>' . "\n";
            $html .= '<input class="special_ability_search_input" id="special_ability_search_input" name="special_ability_search_input" type="text" value="">' . "\n";
            $html .= '<input class="special_ability_search_template" id="special_ability_search_template" name="special_ability_search_template" type="text" value="" hidden>' . "\n";
            $html .= '<input class="special_ability_search_base_class" id="special_ability_search_base_class" name="special_ability_search_base_class" type="text" value="" hidden>' . "\n";
            $html .= '<input name="add_special_ability" type="submit" value="Add">' . "\n";

            $html .= '</div> <!-- end #special_ability_search -->' . "\n";

            $html .= '<div id="special_abilities_suggestions_box">' . "\n";
            $html .= '</div> <!-- end #special_abilities_suggestions_box -->' . "\n";

            $html .= '</div> <!-- end #special_abilities -->' . "\n";

            return $html;
        }

        public function buildLanguages($languages) {
            $languages_array = $languages->getLanguagesArray();

            $html = '';

            $html .= '<div id="languages">' . "\n";
            $html .= '<h2>Languages</h2>' . "\n";
            $html .= '<label for="max_number_of_languages">Max Number Of Languages: </label>';
            $html .= '<input class="languages_input" id="max_number_of_languages" name="max_number_of_languages" type="number" value="' . $languages->getMaxNumberOfLanguages() . '">' . "\n";

            $html .= '<ul>' . "\n";

            foreach($languages_array as $language) {
                $html .= '<li><span>' . ucwords($language) . '</span> <a class="gui remove_language" href="javascript:void()">remove</a></li>' . "\n";
            }

            $html .= '</ul>' . "\n";

            $html .= '<label>New Language: </label>';
            $html .= '<input name="new_language" type="text" value="">' . "\n";
            $html .= '<input name="add_language" type="submit" value="Add Language">' . "\n";

            $html .= '</div> <!-- end #languages -->' . "\n";

            return $html;
        }

        public function buildInventory($inventory) {
            $items = $inventory->getItems();

            $html = '';

            $html .= '<div id="inventory">' . "\n";
            $html .= '<h2>Inventory</h2>' . "\n";
            $html .= '<div>' . "\n";

            if(count($items) < 1) {
                $html .= '<p>You haven\'t added any items yet</p>' . "\n";
            } else {
                $html .= '<table>' . "\n";
                $html .= '<thead>' . "\n";
                $html .= '<tr>' . "\n";
                $html .= '<td>Item</td>' . "\n";
                $html .= '<td>Quantity</td>' . "\n";
                $html .= '<td>Weight Per Unit</td>' . "\n";
                $html .= '<td></td>' . "\n";
                $html .= '</tr>' . "\n";
                $html .= '</thead>' . "\n";
                $html .= '<tbody>' . "\n";

                foreach($items as $item) {
                    $html .= '<tr>' . "\n";
                    $html .= '<td><input class="item_id" type="number" value="' . $item->getId() . '" hidden>';
                    $html .= '<input class="item_name item_input" type="text" maxlength="50" value="' . $item->getName() . '"></td>' . "\n";
                    $html .= '<td><input class="item_quantity item_input" type="number" value="' . $item->getQuantity() . '"></td>' . "\n";
                    $html .= '<td><input class="item_weight item_input" type="number" step="0.01" value="' . $item->getWeight() . '"></td>' . "\n";
                    $html .= '<td><a class="gui remove_item" href="javascript:void()">remove</a></td>' . "\n";
                    $html .= '</tr>' . "\n";
                }

                $html .= '</tbody>' . "\n";
                $html .= '</table>' . "\n";

            }

            $html .= '<input name="add_item" type="submit" value="Add More Space">' . "\n";

            $html .= '</div>' . "\n";

            $html .= '<div>' . "\n";

            $html .= '<label for="inventory_light_load">Light Load: </label>';
            $html .= '<input id="inventory_light_load" class="inventory_input" name="inventory_light_load" type="number" value="' . $inventory->getLightLoad() . '">' . "\n";
            $html .= '<label for="inventory_medium_load">Medium Load: </label>';
            $html .= '<input id="inventory_medium_load" class="inventory_input" name="inventory_medium_load" type="number" value="' . $inventory->getMediumLoad() . '">' . "\n";
            $html .= '<label for="inventory_heavy_load">Heavy Load: </label>';
            $html .= '<input id="inventory_heavy_load" class="inventory_input" name="inventory_heavy_load" type="number" value="' . $inventory->getHeavyLoad() . '">' . "\n";
            $html .= '<label for="inventory_lift_over_head">Lift Over Head: </label>';
            $html .= '<input id="inventory_lift_over_head" class="inventory_input" name="inventory_lift_over_head" type="number" value="' . $inventory->getLiftOverHead() . '">' . "\n";
            $html .= '<label for="inventory_lift_off_ground">Lift Off Ground: </label>';
            $html .= '<input id="inventory_lift_off_ground" class="inventory_input" name="inventory_lift_off_ground" type="number" value="' . $inventory->getLiftOffGround() . '">' . "\n";
            $html .= '<label for="inventory_push_or_drag">Push Or Drag: </label>';
            $html .= '<input id="inventory_push_or_drag" class="inventory_input" name="inventory_push_or_drag" type="number" value="' . $inventory->getPushOrDrag() . '">' . "\n";

            $html .= '</div>' . "\n";

            $html .= '</div> <!-- end #inventory -->' . "\n";

            return $html;
        }

        public function buildCurrencies($currencies) {
            $html = '';

            $html .= '<div id="currencies">' . "\n";
            $html .= '<h2>Purse</h2>' . "\n";

            if(count($currencies) < 1) {
                $html .= '<p>You haven\'t added any currencies yet.</p>' . "\n";
            } else {

                $html .= '<table>' . "\n";
                $html .= '<thead>' . "\n";
                $html .= '<tr>' . "\n";
                $html .= '<td>Currency</td>' . "\n";
                $html .= '<td>Amount</td>' . "\n";
                $html .= '</tr>' . "\n";
                $html .= '</thead>' . "\n";
                $html .= '<tbody>' . "\n";

                foreach($currencies as $currency) {
                    $html .= '<tr>' . "\n";
                    $html .= '<td>' . ucwords($currency->getName()) . '</td>' . "\n";
                    $html .= '<td><input class="currency_input" name="' . $currency->getLabel() . '" type="number" value="' . $currency->getAmount() . '">';
                    $html .= ' <a class="gui remove_currency" href="javascript:void()">remove</a></td>' . "\n";
                    $html .= '</tr>' . "\n";
                }
            }

            $html .= '</tbody>' . "\n";
            $html .= '</table>' . "\n";

            $html .= '<label>New Currency: </label>';
            $html .= '<input name="new_currency" type="text" maxlength="50" value="">' . "\n";
            $html .= '<input name="add_currency" type="submit" value="Add Currency">' . "\n";

            $html .= '</div> <!-- end #currencies -->' . "\n";

            return $html;
        }

    }

}