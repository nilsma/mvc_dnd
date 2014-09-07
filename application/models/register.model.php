<?php
/**
 * a controller class for the application's login page
 */

if(!class_exists('Register_Model')) {

    class Register_Model extends Base_Model {

        public function __construct() {
            parent::__construct();
        }

        public function addUserToDatabase($username, $email, $password) {
            $hashed = $this->hashPassword($password);

            $db = $this->connect();

            $query = "INSERT INTO users VALUES (null, ?,?,?)";
            $query = $db->real_escape_string($query);

            $stmt = $db->stmt_init();
            if(!$stmt->prepare($query)) {
                print("Failed to prepare statement!");
            } else {
                $stmt->bind_param('sss', $username, $email, $hashed);
                $stmt->execute();

                $stmt->close();
                $db->close();
            }
        }

        public function emailExists($email) {
            $exists = true;
            $sql = $this->connect();

            $query = "SELECT id FROM users WHERE email=? LIMIT 1";
            $query = $sql->real_escape_string($query);

            $stmt = $sql->stmt_init();

            if(!$stmt->prepare($query)) {
                print("Failed to prepare query: " . $query . "\n");
            } else {
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                if(($id != NULL) && ($id > 0)) {
                    $exists = true;
                } else {
                    $exists = false;
                }

                $stmt->close();
                $sql->close();
            }

            return $exists;
        }

    }

}
