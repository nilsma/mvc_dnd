<?php
/**
 * a base model class file which extends the database class
 * holds central functions across other model classes, which all extends this base model
 */
require_once '../application/libs/database.class.php';

if(!class_exists('Base_Model')) {

    class Base_Model extends Database {

        public function __construct() { }

        public function validateLogin($username, $password) {
            $db = $this->connect();

            $query = "SELECT password FROM users WHERE username=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $stmt->bind_result($fetched);
                $stmt->fetch();

                if(crypt($password, $fetched) == $fetched) {
                    return true;
                } else {
                    return false;
                }
            }

            $stmt->close();
            $db->close();
        }

        public function usernameExists($username) {
            $id = $this->getUserId($username);

            if($id > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getUsername($user_id) {
            $db = $this->connect();

            $query = "SELECT username FROM users WHERE id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $stmt->bind_result($username);
                $stmt->fetch();

                return $username;
            }

            $stmt->close();
            $db->close();
        }

        public function getUserId($username) {
            $sql = $this->connect();

            $query = "SELECT id FROM users WHERE username=? LIMIT 1";
            $query = mysqli_real_escape_string($sql, $query);

            $stmt = $sql->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed while preparing query");
            } else {
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();

                return $id;
            }
        }

        public function getUserEmail($user_id) {
            $db = $this->connect();

            $query = "SELECT email FROM users WHERE id=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print('Failed to prepare query: ' . $query . "\n");
            } else {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $stmt->bind_result($email);
                $stmt->fetch();

                return $email;
            }
        }

        public function hashPassword($password) {
            //TODO relocate
            $cost = 10;
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            $salt = sprintf("$2a$%02d$", $cost) . $salt;
            $hashed = crypt($password, $salt);

            return $hashed;
        }

        public function getSkillsTemplates() {
            $db = $this->connect();

            $query = "SELECT template_name, common_name, key_ability, description FROM skill_templates";
            $query = $db->real_escape_string($query);

            $skill_templates = array();

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->execute();
                $stmt->bind_result($template_name, $common_name, $key_ability, $description);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $skill_templates[] = array(
                        "template_name" => $template_name,
                        "common_name" => $common_name,
                        "key_ability" => $key_ability,
                        "description" => $description
                    );
                }

                $stmt->close();
            }

            $db->close();
            return $skill_templates;

        }

        /**
         * A method to get all the special ability templates' template_name and common_name in the database ordered
         * alphabetically by common_name as an associative array
         * @param $input - the string which the special ability template must contain to be selected
         * @return array - an associative array where the template_name is the key
         */
        public function getSpecialAbilityTemplates($input) {
            $db = $this->connect();
            $input = '%' . $input . '%';

            $query = "SELECT base_class, template_name, common_name FROM special_ability_templates WHERE common_name LIKE ? ORDER BY common_name LIMIT 7";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $templates = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $input);
                $stmt->execute();
                $stmt->bind_result($base_class, $template_name, $common_name);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $templates[] = array(
                        'base_class' => $base_class,
                        'template_name' => $template_name,
                        'common_name' => $common_name
                    );
                }

                $stmt->close();
            }

            $db->close();
            return $templates;
        }

        /**
         * A method to get all the feat templates' template_name and common_name in the database ordered
         * alphabetically by common_name as an associative array
         * @param $input - the string which the feat template must contain to be selected
         * @return array - an associative array where the template_name is the key
         */
        public function getFeatTemplates($input) {
            $db = $this->connect();
            $input = '%' . $input . '%';

            $query = "SELECT template_name, common_name FROM feat_templates WHERE common_name LIKE ? ORDER BY common_name LIMIT 7";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $templates = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $input);
                $stmt->execute();
                $stmt->bind_result($template_name, $common_name);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $templates[$template_name] = $common_name;
                }

                $stmt->close();
            }

            $db->close();
            return $templates;
        }

        public function getSpellTemplatesClassOnly($input, $class) {
            $db = $this->connect();
            $input = '%' . $input . '%';

            $query = "SELECT st.template_name, st.common_name, sr.base_class, sr.level FROM spell_templates as st, spell_requirements as sr WHERE st.template_name=sr.template_name AND sr.base_class=? AND st.common_name LIKE ? ORDER BY st.common_name LIMIT 7";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $templates = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('ss', $class, $input);
                $stmt->execute();
                $stmt->bind_result($template_name, $common_name, $base_class, $level);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $template = array(
                        'template_name' => $template_name,
                        'common_name' => $common_name,
                        'class' => $base_class,
                        'level' => $level
                    );

                    array_push($templates, $template);
                }

                $stmt->close();
            }

            $db->close();
            return $templates;
        }

        public function getSpellTemplatesClassAndLevel($input, $base_class, $level) {
            $db = $this->connect();
            $input = '%' . $input . '%';

            $query = "SELECT st.template_name, st.common_name, sr.base_class, sr.level FROM spell_templates as st, spell_requirements as sr WHERE st.template_name=sr.template_name AND sr.base_class=? AND sr.level=? AND st.common_name LIKE ? ORDER BY st.common_name LIMIT 7";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();

            $templates = array();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('sis', $base_class, $level, $input);
                $stmt->execute();
                $stmt->bind_result($template_name, $common_name, $base_class, $level);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $template = array(
                        'template_name' => $template_name,
                        'common_name' => $common_name,
                        'class' => $base_class,
                        'level' => $level
                    );

                    array_push($templates, $template);
                }

                $stmt->close();
            }

            $db->close();
            return $templates;
        }

    }

}