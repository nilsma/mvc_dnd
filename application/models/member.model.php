<?php
/**
 * A model class file for the member page
 */
if(!class_exists('Member_Model')) {

    class Member_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getGamemasterScreenOverview($screen_id) {
            $db = $this->connect();

            $query = "SELECT g.alias, c.title FROM gamemasters as g, campaigns as c WHERE g.id=? and g.id=c.owner";
            $query = $db->real_escape_string($query);

            $screen_overview = array();

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $screen_id);
                $stmt->execute();
                $stmt->bind_result($alias, $title);
                $stmt->fetch();
                $screen_overview = array(
                    'alias' => $alias,
                    'title' => $title
                );

                $stmt->close();
            }

            $db->close();
            return $screen_overview;
        }

        public function getCharacterSheetOverview($sheet_id) {
            $db = $this->connect();

            $query = "SELECT p.name, p.class, p.level FROM sheets as s, personalia as p WHERE s.id=? AND s.personalia=p.id";
            $query = $db->real_escape_string($query);

            $sheet_overview = array();

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $sheet_id);
                $stmt->execute();
                $stmt->bind_result($name, $class, $level);
                $stmt->fetch();
                $sheet_overview = array(
                    'name' => $name,
                    'class' => $class,
                    'level' => $level
                );

                $stmt->close();
            }

            $db->close();
            return $sheet_overview;
        }

        public function getAvailableCharacters($user_id) {
            $db = $this->connect();

            $character_sheets = array();

            $query = "SELECT id FROM sheets WHERE owner=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $stmt->bind_result($sheet_id);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $character_sheets[] = $sheet_id;
                }

                $stmt->close();
            }

            $db->close();
            return $character_sheets;
        }

        public function getAvailableGamemasters($user_id) {
            $db = $this->connect();

            $gamemaster_screens = array();

            $query = "SELECT id FROM gamemasters WHERE owner=?";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $stmt->bind_result($screen_id);
                $stmt->store_result();
                while($stmt->fetch()) {
                    $gamemaster_screens[] = $screen_id;
                }

                $stmt->close();
            }

            $db->close();
            return $gamemaster_screens;
        }

    }

}