<?php
/**
 * A model class file for the member page
 */
if(!class_exists('Member_Model')) {

    class Member_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
        }

        public function getAvailableCharacters() {
            $db = $this->connect();

            $character_sheets = array();

            $query = "SELECT p.name, p.class, p.level FROM personalia as p, sheets as s WHERE s.owner=? AND s.personalia=p.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $_SESSION['user_id']);
            }

            $stmt->close();
            $db->close();

            return $character_sheets;
        }

        public function getAvailableGamemasters() {
            $db = $this->connect();

            $gamemaster_screens = array();

            $query = "SELECT p.name, p.class, p.level FROM personalia as p, sheets as s WHERE s.owner=? AND s.personalia=p.id";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('i', $_SESSION['user_id']);
            }

            $stmt->close();
            $db->close();

            return $gamemaster_screens;
        }

    }

}