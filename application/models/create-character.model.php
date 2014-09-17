<?php
/**
 * a model class file for the application"s create_character page
 */
if(!class_exists("Create_Character_Model")) {

    class Create_Character_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
        }

        public function addCharacter($user_id, Character_Sheet $sheet) {
            $db = $this->connect();

            try {
                $db->autocommit(FALSE);

                //begin personalia
                $personalia = $sheet->getPersonalia();
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
                $armor_class = $sheet->getStats()->getArmorClass();
                $stats_id = NULL;

                $ac_total = $armor_class->getAcTotal();
                $ac_base = $armor_class->getAcBase();
                $ac_armor_bonus = $armor_class->getAcArmorBonus();
                $ac_shield_bonus = $armor_class->getAcShieldBonus();
                $ac_dex_mod = $armor_class->getAcDexMod();
                $ac_size_mod = $armor_class->getAcSizeMod();
                $ac_natural_armor = $armor_class->getAcNaturalArmor();

                $query = "INSERT INTO armor_class VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || " . $db->errno);
                }

                $stmt->bind_param('iiiiiii', $ac_total, $ac_base, $ac_armor_bonus, $ac_shield_bonus, $ac_dex_mod, $ac_size_mod, $ac_natural_armor);
                $stmt->execute();
                $armor_class_id = $db->insert_id;
                $stmt->close();

                //begin stats
                $stats = $sheet->getStats();
                $stats_id = NULL;

                $hp = $stats->getHp();
                $wounds = $stats->getWounds();
                $non_lethal = $stats->getNonLethal();
                $armor_class = $armor_class_id;
                $touch_ac = $stats->getTouchAc();
                $flat_footed = $stats->getFlatFooted();
                $initiative_mod = $stats->getInitiativeMod();
                $spell_resistance = $stats->getSpellResistance();
                $speed = $stats->getSpeed();
                $damage_reduction = $stats->getDamageReduction();

                $query = "INSERT INTO stats VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('iiiiiiiiii', $hp, $wounds, $non_lethal, $armor_class, $touch_ac, $flat_footed, $initiative_mod, $spell_resistance, $speed, $damage_reduction);
                $stmt->execute();
                $stats_id = $db->insert_id;
                $stmt->close();

                //begin attributes
                //generate owner id for the attributes
                $attributes = $sheet->getAttributes();
                $attributes_id = NULL;

                $query = "INSERT INTO attributes VALUES(NULL)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->execute();
                $attributes_id = $db->insert_id;
                $stmt->close();

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

                    $stmt->bind_param('isiiii', $attributes_id, $name, $ability_score, $ability_mod, $temp_score, $temp_mod);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin saving throws
                //generate owner id for the savingThrows
                $saving_throws = $sheet->getSavingThrows();
                $saving_throws_id = NULL;

                $query = "INSERT INTO saving_throws VALUES(NULL)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->execute();
                $saving_throws_id = $db->insert_id;
                $stmt->close();

                //begin per saving throw inserts
                foreach($saving_throws as $saving_throw) {
                    $saving_throw_name = $saving_throw->getName();
                    $saving_throw_key_ability = $saving_throw->getKeyAbility();
                    $saving_throw_total = $saving_throw->getTotal();
                    $saving_throw_base_save = $saving_throw->getBaseSave();
                    $saving_throw_ability_modifier = $saving_throw->getAbilityModifier();
                    $saving_throw_magic_modifier = $saving_throw->getMagicModifier();
                    $saving_throw_misc_modifier = $saving_throw->getMiscModifier();
                    $saving_throw_temp_modifier = $saving_throw->getTempModifier();

                    $query = "INSERT INTO saving_throw VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('issiiiiii', $saving_throws_id, $saving_throw_name,
                        $saving_throw_key_ability, $saving_throw_total, $saving_throw_base_save,
                        $saving_throw_ability_modifier, $saving_throw_magic_modifier, $saving_throw_misc_modifier,
                        $saving_throw_temp_modifier);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin languages
                //generate owner id for the languages
                $languages = $sheet->getLanguages();
                $languages_id = NULL;

                $max_no_of_languages = $languages->getMaxNumberOfLanguages();
                $languages_array = $languages->getLanguagesArray();

                $query = "INSERT INTO languages VALUES(NULL, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('i', $max_no_of_languages);
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

                //begin purse
                //generate owner id for the purse
                $purse = $sheet->getPurse();
                $purse_id = NULL;

                $currencies = array(
                    'gold' => $purse->getGold(),
                    'silver' => $purse->getSilver(),
                    'copper' => $purse->getCopper()
                );

                $query = "INSERT INTO purse VALUES(NULL)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->execute();
                $purse_id = $db->insert_id;
                $stmt->close();

                //begin per currency inserts
                foreach($currencies as $key => $value) {

                    $query = "INSERT INTO currency VALUES(?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isi', $purse_id, $key, $value);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin inventory
                //generate owner id for the inventory
                $inventory = $sheet->getInventory();
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

                    $query = "INSERT INTO items VALUES(?, ?, ?, ?)";
                    $query = $db->real_escape_string($query);

                    if(!$stmt  = $db->prepare($query)) {
                        throw new Exception($db->error . " || errno: " . $db->errno);
                    }

                    $stmt->bind_param('isii', $inventory_id, $name, $quantity, $weight);
                    $stmt->execute();
                    $stmt->close();

                }

                //begin attacks
                //generate owner id for the attacks
                $attacks = $sheet->getAttacks();
                $attacks_id = NULL;

                $grapple = $attacks->getGrapple();
                $base_attack_bonus = $attacks->getBaseAttackBonus();
                $number_of_attacks = $attacks->getNumberOfAttacks();

                $grapple_total = $grapple->getGrappleTotal();
                $grapple_bab = $grapple->getGrappleBab();
                $grapple_str_mod = $grapple->getGrappleStrMod();
                $grapple_size_mod = $grapple->getGrappleSizeMod();
                $grapple_misc_mod = $grapple->getGrappleMiscMod();

                //begin grapple
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

                $query = "INSERT INTO attacks VALUES(NULL, ?, ?, ?)";
                $query = $db->real_escape_string($query);

                if(!$stmt  = $db->prepare($query)) {
                    throw new Exception($db->error . " || errno: " . $db->errno);
                }

                $stmt->bind_param('iii', $grapple_id, $base_attack_bonus, $number_of_attacks);
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

                //begin armors
                //generate owner id for the armors
                $armors = $sheet->getArmors();
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

                $db->commit();

            } catch(Exception $e) {
                $db->rollback();
                $db->autocommit(TRUE);
                echo "Caught exception: " . $e->getMessage();
            }

            $db->close();

        }

        public function getSkillsTemplates() {
            $db = $this->connect();

            $query = "SELECT name, label, key_ability, description FROM skill_template";
            $query = $db->real_escape_string($query);

            $skill_templates = array();

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->execute();
                $stmt->bind_result($name, $label, $key_ability, $description);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $skill_templates[] = array(
                        "name" => $name,
                        "label" => $label,
                        "key_ability" => $key_ability,
                        "description" => $description
                    );
                }

                $stmt->close();
            }

            $db->close();
            return $skill_templates;

        }

    }

}