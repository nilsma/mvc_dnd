<?php
/**
 * A class file representing an attribute for the character-sheet
 */

if(!class_exists('Attribute')) {

    class Attribute {

        protected $name;
        protected $ability_score;
        protected $ability_mod;
        protected $temp_score;
        protected $temp_mod;

        public function __construct($entries) {
            $this->name = $entries['name'];
            $this->ability_score = $entries['ability_score'];
            $this->ability_mod = $entries['ability_mod'];
            $this->temp_score = $entries['temp_score'];
            $this->temp_mod = $entries['temp_mod'];
        }

        /**
         * @param mixed $ability_mod
         */
        public function setAbilityMod($ability_mod)
        {
            $this->ability_mod = $ability_mod;
        }

        /**
         * @return mixed
         */
        public function getAbilityMod()
        {
            return $this->ability_mod;
        }

        /**
         * @param mixed $ability_score
         */
        public function setAbilityScore($ability_score)
        {
            $this->ability_score = $ability_score;
        }

        /**
         * @return mixed
         */
        public function getAbilityScore()
        {
            return $this->ability_score;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $temp_mod
         */
        public function setTempMod($temp_mod)
        {
            $this->temp_mod = $temp_mod;
        }

        /**
         * @return mixed
         */
        public function getTempMod()
        {
            return $this->temp_mod;
        }

        /**
         * @param mixed $temp_score
         */
        public function setTempScore($temp_score)
        {
            $this->temp_score = $temp_score;
        }

        /**
         * @return mixed
         */
        public function getTempScore()
        {
            return $this->temp_score;
        }

    }

}