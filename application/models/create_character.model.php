<?php
/**
 * a model class file for the application's create_character page
 */
if(!class_exists('Create_Character_Model')) {

    class Create_Character_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
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
                        'name' => $name,
                        'label' => $label,
                        'key_ability' => $key_ability,
                        'description' => $description
                    );
                }

                $stmt->close();
            }

            $db->close();
            return $skill_templates;

        }

    }

}