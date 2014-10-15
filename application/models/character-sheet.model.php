<?php
/**
 * a model class file for the application"s create_character page
 */
if(!class_exists('Character_Sheet_Model')) {

    class Character_Sheet_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
        }

        public function writePersonalia($sheet_id, Personalia $personalia) {
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

            $db = $this->connect();

            $query = "UPDATE personalia as p, sheets as s SET p.name=?, p.class=?, p.level=?, p.size=?, p.age=?, p.gender=?, p.height=?, p.weight=?, p.eyes=?, p.hair=?, p.skin=?, p.race=?, p.alignment=?, p.deity=?, p.xp=?, p.next_level=? WHERE s.id=? AND s.personalia=p.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('ssisisiissssssiii', $name, $class, $level, $size, $age, $gender, $height, $weight, $eyes, $hair, $skin, $race, $alignment, $deity, $xp, $next_level, $sheet_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function writeStats($sheet_id, Stats $stats) {
            $hp = $stats->getHp();
            $wounds = $stats->getWounds();
            $non_lethal = $stats->getNonLethal();
            $initiative_mod = $stats->getInitiativeMod();
            $spell_resistance = $stats->getSpellResistance();
            $speed = $stats->getSpeed();
            $damage_reduction = $stats->getDamageReduction();

            $db = $this->connect();

            $query = "UPDATE stats as st, sheets as sh SET st.hp=?, st.wounds=?, st.non_lethal=?, st.initiative_mod=?, st.spell_resistance=?, st.speed=?, st.damage_reduction=? WHERE sh.id=? AND sh.stats=st.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('iiiiiiii', $hp, $wounds, $non_lethal, $initiative_mod, $spell_resistance, $speed, $damage_reduction, $sheet_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function writeArmorClass($sheet_id, Armor_Class $armor_class) {
            $total = $armor_class->getAcTotal();
            $base = $armor_class->getAcBase();
            $armor_bonus = $armor_class->getAcArmorBonus();
            $shield_bonus = $armor_class->getAcShieldBonus();
            $dex_mod = $armor_class->getAcDexMod();
            $size_mod = $armor_class->getAcSizeMod();
            $natural_armor = $armor_class->getAcNaturalArmor();
            $touch_ac = $armor_class->getAcTouchAc();
            $flat_footed_ac = $armor_class->getAcFlatFootedAc();

            $db = $this->connect();

            $query = "UPDATE armor_class as ac, sheets as sh SET ac.total=?, ac.base=?, ac.armor_bonus=?, ac.shield_bonus=?, ac.dex_mod=?, ac.size_mod=?, ac.natural_armor=?, ac.touch_ac=?, ac.flat_footed_ac=? WHERE sh.id=? AND sh.armor_class=ac.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('iiiiiiiiii', $total, $base, $armor_bonus, $shield_bonus, $dex_mod, $size_mod, $natural_armor, $touch_ac, $flat_footed_ac, $sheet_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function writeAttribute($sheet_id, Attribute $attribute, $label) {
            $name = $attribute->getName();
            $ability_score = $attribute->getAbilityScore();
            $ability_mod = $attribute->getAbilityMod();
            $temp_score = $attribute->getTempScore();
            $temp_mod = $attribute->getTempMod();

            $db = $this->connect();

            $query = "UPDATE attribute as a, sheets as s SET a.name=?, a.ability_score=?, a.ability_mod=?, a.temp_score=?, a.temp_mod=? WHERE a.name=? AND a.owner=s.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('siiiisi', $name, $ability_score, $ability_mod, $temp_score, $temp_mod, $label, $sheet_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function writeSavingThrow($sheet_id, Saving_Throw $saving_throw, $label) {
            $total = $saving_throw->getTotal();
            $base_save = $saving_throw->getBaseSave();
            $ability_mod = $saving_throw->getAbilityMod();
            $magic_mod = $saving_throw->getMagicMod();
            $misc_mod = $saving_throw->getMiscMod();
            $temp_mod = $saving_throw->getTempMod();

            $db = $this->connect();

            $query = "UPDATE saving_throw as st, sheets as sh SET st.total=?, st.base_save=?, st.ability_mod=?, st.magic_mod=?, st.misc_mod=?, st.temp_mod=? WHERE st.name=? AND st.owner=sh.id AND sh.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('iiiiiisi', $total, $base_save, $ability_mod, $magic_mod, $misc_mod, $temp_mod, $label, $sheet_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function writeAttacks($sheet_id, Array $segments) {
            $base_attack_bonus = $segments['base_attack_bonus'];
            $number_of_attacks = $segments['attacks_per_round'];

            $db = $this->connect();

            $query = "UPDATE attacks as a, sheets as s SET a.base_attack_bonus=?, a.attacks_per_round=? WHERE s.id=? AND s.attacks=a.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('ssi', $base_attack_bonus, $number_of_attacks, $sheet_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function insertItem($sheet_id, Item $item) {
            $name = $item->getName();
            $quantity = $item->getQuantity();
            $weight = $item->getWeight();

            $db = $this->connect();

            $query = "INSERT INTO items VALUES(NULL, ?, ?, ?, ?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('isii', $sheet_id, $name, $quantity, $weight);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function insertSpecialAbility($sheet_id, $template_name) {
            $db = $this->connect();

            $query = "INSERT INTO special_ability VALUES(?, ?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $template_name);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        /**
         * a function to get a special ability templates description based on its common_name
         * @param $template_name - the common_name of the template for which to get the description
         * @return string
         */
        public function getSpecialAbilityInfo($template_name) {
            $db = $this->connect();

            $query = "SELECT description FROM special_ability_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $description = '';

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
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
         * @param $template_name - the common_name of the template for which to get the description
         * @return string
         */
        public function getFeatInfo($template_name) {
            $db = $this->connect();

            $query = "SELECT description FROM feat_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $description = '';

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
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

        public function deleteSpecialAbility($sheet_id, $template_name) {
            $db = $this->connect();

            $query = "DELETE special_ability FROM special_ability, sheets WHERE sheets.id=? AND special_ability.owner=sheets.id AND special_ability.template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $template_name);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function deleteItem($sheet_id, $item_id) {
            $db = $this->connect();

            $query = "DELETE items FROM items, inventory, sheets WHERE sheets.id=? AND inventory.id=sheets.inventory AND items.owner=inventory.id AND items.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $item_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function deleteLanguage($sheet_id, $language) {
            $db = $this->connect();

            $query = "DELETE language FROM language, languages, sheets WHERE sheets.id=? AND languages.id=sheets.languages AND language.owner=languages.id AND language.language=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $language);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function insertFeat($sheet_id, $template_name) {
            $db = $this->connect();

            $query = "INSERT INTO feat VALUES(?, ?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $template_name);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function insertLanguage($languages_id, $language) {
            $db = $this->connect();

            $query = "INSERT INTO language VALUES(?, ?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $languages_id, $language);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function insertCurrency($sheet_id, Currency $currency) {
            $label = $currency->getLabel();
            $name = $currency->getName();
            $amount = $currency->getAmount();

            $db = $this->connect();

            $query = "INSERT INTO currency VALUES(?, ?, ?, ?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('issi', $sheet_id, $label, $name, $amount);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function deleteFeat($sheet_id, $feat_template_name) {
            $db = $this->connect();

            $query = "DELETE feat FROM feat, sheets WHERE feat.owner=sheets.id AND sheets.id=? AND feat.template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $feat_template_name);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function deleteCurrency($sheet_id, $currency_name) {
            $db = $this->connect();

            $query = "DELETE currency FROM currency, sheets WHERE currency.owner=sheets.id AND sheets.id=? AND currency.name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('is', $sheet_id, $currency_name);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function deleteProtectiveItem($sheet_id, $protective_item_id) {
            $db = $this->connect();

            $query = "DELETE protective_item FROM protective_item, armors, sheets WHERE sheets.id=? AND sheets.armors=armors.id AND armors.id=protective_item.owner AND protective_item.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('ii', $sheet_id, $protective_item_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function deleteAttack($sheet_id, $attack_id) {
            $db = $this->connect();

            $query = "DELETE attack FROM attack, attacks, sheets WHERE sheets.id=? AND sheets.attacks=attacks.id AND attacks.id=attack.owner AND attack.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('ii', $sheet_id, $attack_id);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function getProtectiveItemOwnerId($protective_item_id) {
            $db = $this->connect();

            $query = "SELECT u.id FROM users as u, sheets as s, armors as a, protective_item as p WHERE u.id=s.owner AND a.id=s.armors AND p.owner=a.id AND p.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $owner_id = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $protective_item_id);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $owner_id = $result;
                }

                $stmt->close();
            }

            $db->close();
            return $owner_id;
        }

        public function getAttackOwnerId($attack_id) {
            $db = $this->connect();

            $query = "SELECT u.id FROM users AS u, attacks AS atts, attack AS att, sheets AS s WHERE att.owner=atts.id AND atts.id=s.attacks AND s.owner=u.id AND att.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $owner_id = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $attack_id);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $owner_id = $result;
                }

                $stmt->close();
            }

            $db->close();
            return $owner_id;
        }

        public function insertProtectiveItem($sheet_id, $protective_item) {
            $db = $this->connect();

            $name = $protective_item->getName();
            $ac_bonus = $protective_item->getAcBonus();
            $weight = $protective_item->getWeight();
            $special_properties = $protective_item->getSpecialProperties();

            $query = "INSERT INTO protective_item VALUES(NULL, ?, ?, ?, ?, ?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('isiis', $sheet_id, $name, $ac_bonus, $weight, $special_properties);
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function insertAttack($sheet_id, $attack) {
            $db = $this->connect();

            $attacks_id = $this->getAttacksId($sheet_id);

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

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('isisiiissi', $attacks_id, $name, $attack_bonus, $damage, $critical_floor,
                    $critical_ceiling, $weapon_range, $type, $notes, $ammunition
                );
                $stmt->execute();

                $stmt->close();
            }

            $db->close();
        }

        public function getAttacksId($sheet_id) {
            $db = $this->connect();

            $query = "SELECT ats.id FROM attacks as ats, sheets as s WHERE s.attacks=ats.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $attacks_id = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $attacks_id = $result;
                }

                $stmt->close();
            }

            $db->close();
            return $attacks_id;
        }

        public function getPersonalia($sheet_id) {
            $db = $this->connect();

            $query = "SELECT p.name, p.class, p.level, p.size, p.age, p.gender, p.height, p.weight, p.eyes, p.hair, p.skin, p.race, p.alignment, p.deity, p.xp, p.next_level FROM personalia as p, sheets as s WHERE p.id=s.personalia AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $personalia_segments = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($name, $class, $level, $size, $age, $gender, $height, $weight, $eyes, $hair, $skin, $race, $alignment, $deity, $xp, $next_level);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $personalia_segments = array(
                        'name' => $name,
                        'class' => $class,
                        'level' => $level,
                        'size' => $size,
                        'age' => $age,
                        'gender' => $gender,
                        'height' => $height,
                        'weight' => $weight,
                        'eyes' => $eyes,
                        'hair' => $hair,
                        'skin' => $skin,
                        'race' => $race,
                        'alignment' => $alignment,
                        'deity' => $deity,
                        'xp' => $xp,
                        'next_level' => $next_level
                    );
                }

                $stmt->close();
            }

            $db->close();
            return $personalia_segments;
        }

        public function getStats($sheet_id) {
            $db = $this->connect();

            $query = "SELECT st.hp, st.wounds, st.non_lethal, st.initiative_mod, st.spell_resistance, st.speed, st.damage_reduction FROM stats as st, sheets as sh WHERE st.id=sh.stats AND sh.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $stats_segments = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($hp, $wounds, $non_lethal, $initiative_mod, $spell_resistance, $speed, $damage_reduction);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $stats_segments = array(
                        'stats_hp' => $hp,
                        'stats_wounds' => $wounds,
                        'stats_non_lethal' => $non_lethal,
                        'stats_initiative_mod' => $initiative_mod,
                        'stats_spell_resistance' => $spell_resistance,
                        'stats_speed' => $speed,
                        'stats_damage_reduction' => $damage_reduction
                    );
                }

                $stmt->close();

            }

            $db->close();
            return $stats_segments;

        }

        public function getArmorClass($sheet_id) {
            $db = $this->connect();

            $query = "SELECT ac.total, ac.base, ac.armor_bonus, ac.shield_bonus, ac.dex_mod, ac.size_mod, ac.natural_armor, ac.touch_ac, ac.flat_footed_ac FROM armor_class as ac, sheets as s WHERE s.id=? AND s.armor_class=ac.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $armor_class_segments = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($total, $base, $armor_bonus, $shield_bonus, $dex_mod, $size_mod, $natural_armor, $touch_ac, $flat_footed_ac);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $armor_class_segments = array(
                        'ac_total' => $total,
                        'ac_base' => $base,
                        'ac_armor_bonus' => $armor_bonus,
                        'ac_shield_bonus' => $shield_bonus,
                        'ac_dex_mod' => $dex_mod,
                        'ac_size_mod' => $size_mod,
                        'ac_natural_armor' => $natural_armor,
                        'ac_touch_ac' => $touch_ac,
                        'ac_flat_footed_ac' => $flat_footed_ac
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $armor_class_segments;

        }

        public function getAttacks($sheet_id) {
            $db = $this->connect();

            $query = "SELECT atts.id, atts.base_attack_bonus, atts.attacks_per_round FROM attacks as atts, sheets as sh WHERE atts.id=sh.attacks AND sh.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $attacks_segments = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($attacks_id, $base_attack_bonus, $attacks_per_round);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $attacks_segments = array(
                        'attacks_id' => $attacks_id,
                        'base_attack_bonus' => $base_attack_bonus,
                        'attacks_per_round' => $attacks_per_round
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $attacks_segments;

        }

        public function getGrapple($sheet_id) {
            $db = $this->connect();

            $query = "SELECT g.total, g.base_attack_bonus, g.str_mod, g.size_mod, g.misc_mod FROM grapple as g, sheets as s WHERE s.id=? AND s.grapple=g.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $grapple_segments = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($total, $base_attack_bonus, $str_mod, $size_mod, $misc_mod);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $grapple_segments = array(
                        'grapple_total' => $total,
                        'grapple_bab' => $base_attack_bonus,
                        'grapple_str_mod' => $str_mod,
                        'grapple_size_mod' => $size_mod,
                        'grapple_misc_mod' => $misc_mod
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $grapple_segments;
        }

        public function getAttacksArray($attacks_id) {
            $db = $this->connect();

            $query = "SELECT att.id, att.name, att.attack_bonus, att.damage, att.critical_floor, att.critical_ceiling, att.weapon_range, att.type, att.notes, att.ammunition FROM attack as att, attacks as atts WHERE att.owner=atts.id AND atts.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $attacks_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $attacks_id);
                $stmt->execute();
                $stmt->bind_result($attack_id, $name, $attack_bonus, $damage, $critical_floor, $critical_ceiling, $weapon_range, $type, $notes, $ammunition);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $attack_array = array(
                        'attack_id' => $attack_id,
                        'attack_name' => $name,
                        'attack_bonus' => $attack_bonus,
                        'attack_damage' => $damage,
                        'critical_floor' => $critical_floor,
                        'critical_ceiling' => $critical_ceiling,
                        'weapon_range' => $weapon_range,
                        'attack_type' => $type,
                        'attack_notes' => $notes,
                        'ammunition' => $ammunition
                    );

                    array_push($attacks_array, $attack_array);
                }
                $stmt->close();
            }

            $db->close();
            return $attacks_array;

        }

        public function getSkills($sheet_id) {
            $db = $this->connect();

            $query = "SELECT sk.id, sk.max_ranks_class, sk.max_ranks_cross_class FROM skills as sk, sheets as sh WHERE sk.id=sh.skills AND sh.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $skills_segments = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($skills_id, $max_ranks_class, $max_ranks_cross_class);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $skills_segments = array(
                        'skills_id' => $skills_id,
                        'max_ranks_class' => $max_ranks_class,
                        'max_ranks_cross_class' => $max_ranks_cross_class
                    );

                }
                $stmt->close();
            }

            $db->close();
            return $skills_segments;

        }

        public function getSkillArray($skills_id) {
            $db = $this->connect();

            $query = "SELECT s.template_name, s.skill_mod, s.ability_mod, s.ranks, s.misc_mod FROM skill as s, skills as ss WHERE s.owner=ss.id AND ss.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $skill_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $skills_id);
                $stmt->execute();
                $stmt->bind_result($template_name, $skill_mod, $ability_mod, $ranks, $misc_mod);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $skill = array(
                        'template_name' => $template_name,
                        'skill_mod' => $skill_mod,
                        'ability_mod' => $ability_mod,
                        'ranks' => $ranks,
                        'misc_mod' => $misc_mod
                    );

                    array_push($skill_array, $skill);
                }
                $stmt->close();
            }

            $db->close();
            return $skill_array;

        }

        public function getInventory($sheet_id) {
            $db = $this->connect();

            $query = "SELECT i.id, i.light_load, i.medium_load, i.heavy_load, i.lift_over_head, i.lift_off_ground, i.push_or_drag FROM inventory as i, sheets as s WHERE i.id=s.inventory AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $inventory = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($inventory_id, $light_load, $medium_load, $heavy_load, $lift_over_head, $lift_off_ground, $push_or_drag);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $inventory = array(
                        'inventory_id' => $inventory_id,
                        'light_load' => $light_load,
                        'medium_load' => $medium_load,
                        'heavy_load' => $heavy_load,
                        'lift_over_head' => $lift_over_head,
                        'lift_off_ground' => $lift_off_ground,
                        'push_or_drag' => $push_or_drag
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $inventory;
        }

        public function getItemsArray($inventory_id) {
            $db = $this->connect();

            $query = "SELECT it.id, it.name, it.quantity, it.weight_per_unit FROM items as it, inventory as inv WHERE it.owner=inv.id AND inv.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $items_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $inventory_id);
                $stmt->execute();
                $stmt->bind_result($id, $name, $quantity, $weight_per_unit);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $item = array(
                        'item_id' => $id,
                        'item_name' => $name,
                        'item_quantity' => $quantity,
                        'item_weight' => $weight_per_unit
                    );

                    array_push($items_array, $item);
                }
                $stmt->close();
            }

            $db->close();
            return $items_array;
        }

        public function getLanguages($sheet_id) {
            $db = $this->connect();

            $query = "SELECT l.id, l.max_number_of_languages FROM languages as l, sheets as s WHERE l.id=s.languages AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $languages = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($id, $max_number_of_languages);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $languages = array(
                        'languages_id' => $id,
                        'max_number_of_languages' => $max_number_of_languages
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $languages;
        }

        public function getLanguageArray($languages_id) {
            $db = $this->connect();

            $query = "SELECT l.language FROM language as l, languages as ls WHERE l.owner=ls.id AND ls.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $language_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $languages_id);
                $stmt->execute();
                $stmt->bind_result($language_name);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $language_array[] = $language_name;

                }
                $stmt->close();
            }

            $db->close();
            return $language_array;
        }

        public function getArmors($sheet_id) {
            $db = $this->connect();

            $query = "SELECT a.id FROM armors as a, sheets as s WHERE s.armors=a.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $armor_id = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $armors_id = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $armors_id;
        }

        public function getArmor($armors_id) {
            $db = $this->connect();

            $query = "SELECT a.name, a.type, a.ac_bonus, a.max_dex, a.check_penalty, a.spell_failure, a.speed, a.weight, a.special_properties FROM armor as a, armors WHERE a.owner=armors.id AND armors.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $armor = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $armors_id);
                $stmt->execute();
                $stmt->bind_result($name, $type, $ac_bonus, $max_dex, $check_penalty, $spell_failure, $speed, $weight, $special_properties);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $armor = array(
                        'armor_name' => $name,
                        'armor_type' => $type,
                        'armor_ac_bonus' => $ac_bonus,
                        'armor_max_dex' => $max_dex,
                        'armor_check_penalty' => $check_penalty,
                        'armor_spell_failure' => $spell_failure,
                        'armor_speed' => $speed,
                        'armor_weight' => $weight,
                        'armor_special_properties' => $special_properties
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $armor;
        }

        public function getShield($armors_id) {
            $db = $this->connect();

            $query = "SELECT s.name, s.ac_bonus, s.weight, s.check_penalty, s.spell_failure, s.special_properties FROM shield as s, armors WHERE s.owner=armors.id AND armors.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $shield = NULL;

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $armors_id);
                $stmt->execute();
                $stmt->bind_result($name, $ac_bonus, $weight, $check_penalty, $spell_failure, $special_properties);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $shield = array(
                        'shield_name' => $name,
                        'shield_ac_bonus' => $ac_bonus,
                        'shield_weight' => $weight,
                        'shield_check_penalty' => $check_penalty,
                        'shield_spell_failure' => $spell_failure,
                        'shield_special_properties' => $special_properties
                    );
                }
                $stmt->close();
            }

            $db->close();
            return $shield;
        }

        public function getProtectiveItems($armors_id) {
            $db = $this->connect();

            $query = "SELECT p.id, p.name, p.ac_bonus, p.weight, p.special_properties FROM protective_item as p, armors WHERE p.owner=armors.id AND armors.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $protective_items_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $armors_id);
                $stmt->execute();
                $stmt->bind_result($id, $name, $ac_bonus, $weight, $special_properties);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $protective_item = array(
                        'protective_item_id' => $id,
                        'protective_item_name' => $name,
                        'protective_item_ac_bonus' => $ac_bonus,
                        'protective_item_weight' => $weight,
                        'protective_item_special_properties' => $special_properties
                    );

                    array_push($protective_items_array, $protective_item);
                }
                $stmt->close();
            }

            $db->close();
            return $protective_items_array;
        }

        public function getAttributes($sheet_id) {
            $db = $this->connect();

            $query = "SELECT a.name, a.ability_score, a.ability_mod, a.temp_score, a.temp_mod FROM attribute as a, sheets as s WHERE a.owner=s.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $attributes_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($name, $ability_score, $ability_mod, $temp_score, $temp_mod);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $attribute = array(
                        'name' => $name,
                        'ability_score' => $ability_score,
                        'ability_mod' => $ability_mod,
                        'temp_score' => $temp_score,
                        'temp_mod' => $temp_mod
                    );

                    array_push($attributes_array, $attribute);
                }
                $stmt->close();
            }

            $db->close();
            return $attributes_array;
        }

        public function getSavingThrows($sheet_id) {
            $db = $this->connect();

            $query = "SELECT st.name, st.key_ability, st.total, st.base_save, st.ability_mod, st.magic_mod, st.misc_mod, st.temp_mod FROM saving_throw as st, sheets as s WHERE st.owner=s.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $saving_throws_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($name, $key_ability, $total, $base_save, $ability_mod, $magic_mod, $misc_mod, $temp_mod);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $saving_throw = array(
                        'name' => $name,
                        'key_ability' => $key_ability,
                        'total' => $total,
                        'base_save' => $base_save,
                        'ability_mod' => $ability_mod,
                        'magic_mod' => $magic_mod,
                        'misc_mod' => $misc_mod,
                        'temp_mod' => $temp_mod
                    );

                    array_push($saving_throws_array, $saving_throw);
                }
                $stmt->close();
            }

            $db->close();
            return $saving_throws_array;
        }

        public function getFeats($sheet_id) {
            $db = $this->connect();

            $query = "SELECT f.template_name FROM feat as f, sheets as s WHERE f.owner=s.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $feats_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($template_name);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $feats_array[] = $template_name;
                }
                $stmt->close();
            }

            $db->close();
            return $feats_array;
        }

        public function getSpecialAbilities($sheet_id) {
            $db = $this->connect();

            $query = "SELECT sa.template_name FROM special_ability as sa, sheets as s WHERE sa.owner=s.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $special_abilities_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($template_name);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $special_abilities_array[] = $template_name;
                }
                $stmt->close();
            }

            $db->close();
            return $special_abilities_array;
        }

        public function getCurrencies($sheet_id) {
            $db = $this->connect();

            $query = "SELECT c.label, c.name, c.amount FROM currency as c, sheets as s WHERE c.owner=s.id AND s.id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $currencies_array = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($label, $name, $amount);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $currency = array(
                        'label' => $label,
                        'name' => $name,
                        'amount' => $amount
                    );

                    array_push($currencies_array, $currency);
                }
                $stmt->close();
            }

            $db->close();
            return $currencies_array;
        }

        public function getSkillCommonName($template_name) {
            $db = $this->connect();

            $query = "SELECT common_name FROM skill_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $common_name = '';

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $common_name = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $common_name;
        }

        public function getSkillKeyAbility($template_name) {
            $db = $this->connect();

            $query = "SELECT key_ability FROM skill_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $key_ability = '';

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $key_ability = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $key_ability;
        }

        public function getSkillDescription($template_name) {
            $db = $this->connect();

            $query = "SELECT description FROM skill_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $description = '';

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $description = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $description;
        }

        public function getFeatCommonName($template_name) {
            $db = $this->connect();

            $query = "SELECT common_name FROM feat_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $common_name = '';

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $common_name = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $common_name;
        }

        public function getSpecialAbilityCommonName($template_name) {
            $db = $this->connect();

            $query = "SELECT common_name FROM special_ability_templates WHERE template_name=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $common_name = '';

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $template_name);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $common_name = $result;
                }
                $stmt->close();
            }

            $db->close();
            return $common_name;
        }

    }

}