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


    }
}