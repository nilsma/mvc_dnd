<?php
if(!class_exists('Personalia')) {

    class Personalia {

        protected $name;
        protected $class;
        protected $level;
        protected $size;
        protected $age;
        protected $gender;
        protected $height;
        protected $weight;
        protected $eyes;
        protected $hair;
        protected $skin;
        protected $race;
        protected $alignment;
        protected $deity;
        protected $xp;
        protected $next_level;

        public function __construct($entries) {
            $this->setName($entries['name']);
            $this->setClass($entries['class']);
            $this->setLevel($entries['level']);
            $this->setSize($entries['size']);
            $this->setAge($entries['age']);
            $this->setGender($entries['gender']);
            $this->setHeight($entries['height']);
            $this->setWeight($entries['weight']);
            $this->setEyes($entries['eyes']);
            $this->setHair($entries['hair']);
            $this->setSkin($entries['skin']);
            $this->setRace($entries['race']);
            $this->setAlignment($entries['alignment']);
            $this->setDeity($entries['deity']);
            $this->setXp($entries['xp']);
            $this->setNextLevel($entries['next_level']);
        }

        /**
         * @param mixed $age
         */
        public function setAge($age) {

            if($age > 0 && !empty($age)) {
                $this->age = $age;
            } else {
                $this->age = 18;
            }

        }

        /**
         * @return mixed
         */
        public function getAge() {
            return $this->age;
        }

        /**
         * @param mixed $alignment
         */
        public function setAlignment($alignment) {

            if(!empty($alignment)) {
                $this->alignment = $alignment;
            } else {
                $this->alignment = 'Alignment';
            }
        }

        /**
         * @return mixed
         */
        public function getAlignment() {
            return $this->alignment;
        }

        /**
         * @param mixed $class
         */
        public function setClass($class) {

            if(!empty($class)) {
                $this->class = $class;
            } else {
                $this->class = 'Class';
            }
        }

        /**
         * @return mixed
         */
        public function getClass() {
            return $this->class;
        }

        /**
         * @param mixed $deity
         */
        public function setDeity($deity) {

            if(!empty($deity)) {
                $this->deity = $deity;
            } else {
                $this->deity = 'Deity';
            }
        }

        /**
         * @return mixed
         */
        public function getDeity() {
            return $this->deity;
        }

        /**
         * @param mixed $eyes
         */
        public function setEyes($eyes) {

            if(!empty($eyes)) {
                $this->eyes = $eyes;
            } else {
                $this->eyes = 'Eyes';
            }
        }

        /**
         * @return mixed
         */
        public function getEyes() {
            return $this->eyes;
        }

        /**
         * @param mixed $gender
         */
        public function setGender($gender) {

            if(!empty($gender)) {
                $this->gender = $gender;
            } else {
                $this->gender = 'Gender';
            }
        }

        /**
         * @return mixed
         */
        public function getGender() {
            return $this->gender;
        }

        /**
         * @param mixed $hair
         */
        public function setHair($hair) {

            if(!empty($hair)) {
                $this->hair = $hair;
            } else {
                $this->hair = 'Hair';
            }
        }

        /**
         * @return mixed
         */
        public function getHair() {
            return $this->hair;
        }

        /**
         * @param mixed $height
         */
        public function setHeight($height) {

            if(!empty($height) && $height > 0) {
                $this->height = $height;
            } else {
                $this->height = 180;
            }
        }

        /**
         * @return mixed
         */
        public function getHeight() {
            return $this->height;
        }

        /**
         * @param mixed $level
         */
        public function setLevel($level) {

            if(!empty($level) && $level > 0) {
                $this->level = $level;
            } else {
                $this->level = 1;
            }
        }

        /**
         * @return mixed
         */
        public function getLevel() {
            return $this->level;
        }

        /**
         * @param mixed $name
         */
        public function setName($name) {

            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = 'Character Name';
            }
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @param mixed $next_level
         */
        public function setNextLevel($next_level) {

            if(!empty($next_level) && $next_level > 0) {
                $this->next_level = $next_level;
            } else {
                $this->next_level = 2000;
            }
        }

        /**
         * @return mixed
         */
        public function getNextLevel() {
            return $this->next_level;
        }

        /**
         * @param mixed $race
         */
        public function setRace($race) {

            if(!empty($race)) {
                $this->race = $race;
            } else {
                $this->race = 'Race';
            }
        }

        /**
         * @return mixed
         */
        public function getRace() {
            return $this->race;
        }

        /**
         * @param mixed $size
         */
        public function setSize($size) {

            if(!empty($size)) {
                $this->size = $size;
            } else {
                $this->size = 'Size';
            }
        }

        /**
         * @return mixed
         */
        public function getSize() {
            return $this->size;
        }

        /**
         * @param mixed $skin
         */
        public function setSkin($skin) {

            if(!empty($skin)) {
                $this->skin = $skin;
            } else {
                $this->skin = 'Skin';
            }
        }

        /**
         * @return mixed
         */
        public function getSkin() {
            return $this->skin;
        }

        /**
         * @param mixed $weight
         */
        public function setWeight($weight) {

            if(!empty($weight) && $weight > 0) {
                $this->weight = $weight;
            } else {
                $this->weight = 80;
            }
        }

        /**
         * @return mixed
         */
        public function getWeight() {
            return $this->weight;
        }

        /**
         * @param mixed $xp
         */
        public function setXp($xp) {

            if(!empty($xp) && $xp > 0) {
                $this->xp = $xp;
            } else {
                $this->xp = 1000;
            }
        }

        /**
         * @return mixed
         */
        public function getXp() {
            return $this->xp;
        }

    }

}