<?php
/**
 * a model class file for the application"s create_character page
 */
if(!class_exists("Create_Character_Model")) {

    class Create_Character_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
        }

        public function addCharacter($user_id, $character_segments) {
            $db = $this->connect();

            $sheet_id = NULL;

            try {
                $db->autocommit(FALSE);

                //begin personalia
                $personalia = $character_segments['personalia'];
                $personalia_id = NULL;

                $name = $personalia->getName();
                $class = $personalia->getClass();
                $level = $personalia->getLevel();
                $size = $personalia->getSize();
                $age = $personalia->getAge();
                $gender = $personalia->getGender();
                $height = $personalia->getHeight();
                $weight = $personalia->getWeight();
                $eyes = $personalia->getEyes();
                $hair = $personalia->getHair();
                $skin = $personalia->getSkin();
                $race = $personalia->getRace();
                $alignment = $personalia->getAlignment();
                $deity = $personalia->getDeity();
                $xp = $personalia->getXp();
                $next_level = $personalia->getNextLevel();

                $query = "INSERT INTO personalia VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || " . $db->errno);
                }

                $stmt->bind_param('ssisisiissssssii', $name, $class, $level, $size, $age, $gender, $height, $weight, $eyes, $hair, $skin, $race, $alignment, $deity, $xp, $next_level);
                $stmt->execute();
                $personalia_id = $db->insert_id;
                $stmt->close();

                //begin armor class
                $armor_class = $character_segments['armor_class'];

                $armor_class_id = NULL;

                $ac_total = $armor_class->getAcTotal();
                $ac_base = $armor_class->getAcBase();
                $ac_armor_bonus = $armor_class->getAcArmorBonus();
                $ac_shield_bonus = $armor_class->getAcShieldBonus();
                $ac_dex_mod = $armor_class->getAcDexMod();
                $ac_size_mod = $armor_class->getAcSizeMod();
                $ac_natural_armor = $armor_class->getAcNaturalArmor();
                $ac_touch_ac = $armor_class->getAcTouchAc();
                $ac_flat_footed_ac = $armor_class->getAcFlatFootedAc();

                $query = "INSERT INTO armor_class VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || " . $db->errno);
                }

                $stmt->bind_param('iiiiiiiii', $ac_total, $ac_base, $ac_armor_bonus, $ac_shield_bonus, $ac_dex_mod, $ac_size_mod, $ac_natural_armor, $ac_touch_ac, $ac_flat_footed_ac);
                $stmt->execute();
                $armor_class_id = $db->insert_id;
                $stmt->close();

                //begin stats
                $stats = $character_segments['stats'];

                $stats_id = NULL;

                $hp = $stats->getHp();
                $wounds = $stats->getWounds();
                $non_lethal = $stats->getNonLethal();
                $initiative_mod = $stats->getInitiativeMod();
                $spell_resistance = $stats->getSpellResistance();
                $speed = $stats->getSpeed();
                $damage_reduction = $stats->getDamageReduction();

                $query = "INSERT INTO stats VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('iiiiiii', $hp, $wounds, $non_lethal, $initiative_mod, $spell_resistance, $speed, $damage_reduction);
                $stmt->execute();
                $stats_id = $db->insert_id;
                $stmt->close();

                //begin grapple
                $grapple = $character_segments['grapple'];

                $grapple_total = $grapple->getGrappleTotal();
                $grapple_bab = $grapple->getGrappleBab();
                $grapple_str_mod = $grapple->getGrappleStrMod();
                $grapple_size_mod = $grapple->getGrappleSizeMod();
                $grapple_misc_mod = $grapple->getGrappleMiscMod();

                $graple_id = NULL;

                $query = "INSERT INTO grapple VALUES(NULL, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('iiiii', $grapple_total, $grapple_bab, $grapple_str_mod, $grapple_size_mod,
                    $grapple_misc_mod
                );

                $stmt->execute();
                $grapple_id = $db->insert_id;
                $stmt->close();

                //begin attacks
                $attacks = $character_segments['attacks'];

                $base_attack_bonus = $attacks->getBaseAttackBonus();
                $number_of_attacks = $attacks->getNumberOfAttacks();

                $attacks_id = NULL;

                $query = "INSERT INTO attacks VALUES(NULL, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('ii', $base_attack_bonus, $number_of_attacks);
                $stmt->execute();
                $attacks_id = $db->insert_id;
                $stmt->close();

                //begin per attack inserts
                $attacks_array = $attacks->getAttacksArray();

                foreach($attacks_array as $attack) {
                    $name = $attack->getName();
                    $attack_bonus = $attack->getAttackBonus();
                    $damage = $attack->getDamage();
                    $critical_floor = $attack->getCriticalFloor();
                    $critical_ceiling = $attack->getCriticalCeiling();
                    $weapon_range = $attack->getWeaponRange();
                    $type = $attack->getType();
                    $notes = $attack->getNotes();
                    $ammunition = $attack->getAmmunition();

                    $query = "INSERT INTO attack VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isisiiissi', $attacks_id, $name, $attack_bonus, $damage, $critical_floor,
                        $critical_ceiling, $weapon_range, $type, $notes, $ammunition);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin skills insert
                $skills = $character_segments['skills'];
                $skills_id = NULL;

                $max_ranks_class = $skills->getMaxRanksClass();
                $max_ranks_cross_class = $skills->getMaxRanksCrossClass();

                $query = "INSERT INTO skills VALUES(NULL, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('ii', $max_ranks_class, $max_ranks_cross_class);

                $stmt->execute();
                $skills_id = $db->insert_id;
                $stmt->close();

                //begin per skill inserts
                $skill_array = $skills->getSkillArray();

                foreach($skill_array as $skill) {
                    $template_name = $skill->getTemplateName();
                    $skill_mod = $skill->getSkillMod();
                    $ability_mod = $skill->getAbilityMod();
                    $ranks = $skill->getRanks();
                    $misc_mod = $skill->getMiscMod();

                    $query = "INSERT INTO skill VALUES(?, ?, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isiiii', $skills_id, $template_name, $skill_mod, $ability_mod,
                        $ranks, $misc_mod
                    );
                    $stmt->execute();
                    $stmt->close();

                }

                //begin inventory
                //generate owner id for the inventory
                $inventory = $character_segments['inventory'];
                $inventory_id = NULL;

                $inventory_light_load = $inventory->getLightLoad();
                $inventory_medium_load = $inventory->getMediumLoad();
                $inventory_heavy_load = $inventory->getHeavyLoad();
                $inventory_lift_over_head = $inventory->getLiftOverHead();
                $inventory_lift_off_ground = $inventory->getLiftOffGround();
                $inventory_push_or_drag = $inventory->getPushOrDrag();

                $query = "INSERT INTO inventory VALUES(NULL, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('iiiiii', $inventory_light_load, $inventory_medium_load,
                    $inventory_heavy_load, $inventory_lift_off_ground, $inventory_lift_over_head,
                    $inventory_push_or_drag
                );
                $stmt->execute();
                $inventory_id = $db->insert_id;
                $stmt->close();

                //begin per item inserts
                $items = $inventory->getItems();

                foreach($items as $item) {
                    $name = $item->getName();
                    $weight = $item->getWeight();
                    $quantity = $item->getQuantity();

                    $query = "INSERT INTO items VALUES(NULL, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isid', $inventory_id, $name, $quantity, $weight);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin languages
                //generate owner id for the languages
                $languages = $character_segments['languages'];
                $languages_id = NULL;

                $max_number_of_languages = $languages->getMaxNumberOfLanguages();
                $languages_array = $languages->getLanguagesArray();

                $query = "INSERT INTO languages VALUES(NULL, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('i', $max_number_of_languages);
                $stmt->execute();
                $languages_id = $db->insert_id;
                $stmt->close();

                //begin per language inserts
                foreach($languages_array as $language) {

                    $query = "INSERT INTO language VALUES(?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('is', $languages_id, $language);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin armors
                //generate owner id for the armors
                $armors = $character_segments['armors'];
                $armors_id = NULL;

                $query = "INSERT INTO armors VALUES(NULL)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->execute();
                $armors_id = $db->insert_id;
                $stmt->close();

                //begin armor insert
                $armor = $armors->getArmor();
                $name = $armor->getName();
                $type = $armor->getType();
                $ac_bonus = $armor->getAcBonus();
                $max_dex = $armor->getMaxDex();
                $check_penalty = $armor->getCheckPenalty();
                $spell_failure = $armor->getSpellFailure();
                $speed = $armor->getSpeed();
                $weight = $armor->getWeight();
                $special_properties = $armor->getSpecialProperties();

                $query = "INSERT INTO armor VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('issiiiiiis', $armors_id, $name, $type, $ac_bonus, $max_dex, $check_penalty,
                    $spell_failure, $speed, $weight, $special_properties
                );

                $stmt->execute();
                $stmt->close();

                //begin shield insert
                $shield = $armors->getShield();
                $name = $shield->getName();
                $ac_bonus = $shield->getAcBonus();
                $weight = $shield->getWeight();
                $check_penalty = $shield->getCheckPenalty();
                $spell_failure = $shield->getSpellFailure();
                $special_properties = $shield->getSpecialProperties();

                $query = "INSERT INTO shield VALUES(?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('isiiiis', $armors_id, $name, $ac_bonus, $weight, $check_penalty,
                    $spell_failure, $special_properties
                );

                $stmt->execute();
                $stmt->close();

                //begin per protective items inserts
                $protective_items_array = $armors->getProtectiveItems();

                foreach($protective_items_array as $protective_item) {
                    $name = $protective_item->getName();
                    $ac_bonus = $protective_item->getAcBonus();
                    $weight = $protective_item->getWeight();
                    $special_properties = $protective_item->getSpecialProperties();

                    $query = "INSERT INTO protective_item VALUES(NULL, ?, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isiis', $armors_id, $name, $ac_bonus, $weight, $special_properties);
                    $stmt->execute();
                    $stmt->close();

                }

                //BEGIN SHEET INSERT
                $query = "INSERT INTO sheets VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('iiiiiiiiii', $user_id, $personalia_id, $stats_id, $attacks_id, $skills_id,
                    $inventory_id, $languages_id, $armors_id, $armor_class_id, $grapple_id
                );
                $stmt->execute();
                $sheet_id = $db->insert_id;
                $stmt->close();

                //begin attributes
                //generate owner id for the attributes
                $attributes = $character_segments['attributes'];

                //begin per attribute inserts
                foreach($attributes as $attribute) {
                    $name = $attribute->getName();
                    $ability_score = $attribute->getAbilityScore();
                    $ability_mod = $attribute->getAbilityMod();
                    $temp_score = $attribute->getTempScore();
                    $temp_mod = $attribute->getTempMod();

                    $query = "INSERT INTO attribute VALUES(?, ?, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isiiii', $sheet_id, $name, $ability_score, $ability_mod,
                        $temp_score, $temp_mod
                    );
                    $stmt->execute();
                    $stmt->close();

                }

                //begin saving throws
                //generate owner id for the savingThrows
                $saving_throws = $character_segments['saving_throws'];

                //begin per saving throw inserts
                foreach($saving_throws as $saving_throw) {
                    $saving_throw_name = $saving_throw->getName();
                    $saving_throw_key_ability = $saving_throw->getKeyAbility();
                    $saving_throw_total = $saving_throw->getTotal();
                    $saving_throw_base_save = $saving_throw->getBaseSave();
                    $saving_throw_ability_mod = $saving_throw->getAbilityMod();
                    $saving_throw_magic_mod = $saving_throw->getMagicMod();
                    $saving_throw_misc_mod = $saving_throw->getMiscMod();
                    $saving_throw_temp_mod = $saving_throw->getTempMod();

                    $query = "INSERT INTO saving_throw VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('issiiiiii', $sheet_id, $saving_throw_name,
                        $saving_throw_key_ability, $saving_throw_total, $saving_throw_base_save,
                        $saving_throw_ability_mod, $saving_throw_magic_mod, $saving_throw_misc_mod,
                        $saving_throw_temp_mod);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin purse
                //generate owner id for the purse
                $purse = $character_segments['purse'];

                //begin per currency inserts
                foreach($purse as $currency) {
                    $label = $currency->getLabel();
                    $name = $currency->getName();
                    $amount = $currency->getAmount();

                    $query = "INSERT INTO currency VALUES(?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('issi', $sheet_id, $label, $name, $amount);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin special abilities insert
                $special_abilities = $character_segments['special_abilities'];

                foreach($special_abilities as $special_ability) {
                    $template_name = $special_ability->getTemplateName();

                    $query = "INSERT INTO special_ability VALUES(?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('is', $sheet_id, $template_name);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin feats insert
                $feats = $character_segments['feats'];

                foreach($feats as $feat) {
                    $template_name = $feat->getTemplateName();

                    $query = "INSERT INTO feat VALUES(?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('is', $sheet_id, $template_name);
                    $stmt->execute();
                    $stmt->close();

                }

                $db->commit();

            } catch(Exception $e) {
                $db->rollback();
                $db->autocommit(TRUE);
                echo "Caught exception: " . $e->getMessage();
            }

            $db->close();
            return $sheet_id;

        }

        /**
         * a function to get a special ability templates common_name based on its template_name
         * @param $template_name - the template for which to get the common_name
         * @return string
         */
        public function getSpecialAbilityCommonName($template_name) {
            $db = $this->connect();

            $query = "SELECT common_name FROM special_ability_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $common_name = '';

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                while($stmt->fetch()) {
                    $common_name = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $common_name;
        }

        /**
         * a function to get a feat templates common_name based on its template_name
         * @param $template_name - the template for which to get the common_name
         * @return string
         */
        public function getFeatCommonName($template_name) {
            $db = $this->connect();

            $query = "SELECT common_name FROM feat_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $common_name = '';

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                while($stmt->fetch()) {
                    $common_name = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $common_name;
        }

        /**
         * a function to get a special ability templates description based on its common_name
         * @param $common_name - the common_name of the template for which to get the description
         * @return string
         */
        public function getSpecialAbilityInfo($common_name) {
            $db = $this->connect();

            $query = "SELECT description FROM special_ability_templates WHERE common_name=?";
            $query = $db->real_escape_string($query);

            $description = '';

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $common_name);
                $stmt->execute();
                $stmt->bind_result($result);
                while($stmt->fetch()) {
                    $description = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $description;
        }

        /**
         * a function to get a feat templates description based on its common_name
         * @param $common_name - the common_name of the template for which to get the description
         * @return string
         */
        public function getFeatInfo($common_name) {
            $db = $this->connect();

            $query = "SELECT description FROM feat_templates WHERE common_name=?";
            $query = $db->real_escape_string($query);

            $description = '';

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $common_name);
                $stmt->execute();
                $stmt->bind_result($result);
                while($stmt->fetch()) {
                    $description = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $description;
        }

    }

}