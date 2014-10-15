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
            $this->setName($entries['name']);
            $this->setAbilityScore($entries['ability_score']);
            $this->setAbilityMod($entries['ability_mod']);
            $this->setTempScore($entries['temp_score']);
            $this->setTempMod($entries['temp_mod']);
        }

        /**
         * @param mixed $ability_mod
         */
        public function setAbilityMod($ability_mod)
        {
            if(!empty($ability_mod) && $ability_mod >= 0) {
                $this->ability_mod = $ability_mod;
            } else {
                $this->ability_mod = 0;
            }

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
            if(!empty($ability_score) && $ability_score >= 0) {
                $this->ability_score = $ability_score;
            } else {
                $this->ability_score = 0;
            }

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
            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = 'Ability Name';
            }

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
            if(!empty($temp_mod) && $temp_mod >= 0) {
                $this->temp_mod = $temp_mod;
            } else {
                $this->temp_mod = 0;
            }

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
            if(!empty($temp_score) && $temp_score >= 0) {
                $this->temp_score = $temp_score;
            } else {
                $this->temp_score = 0;
            }

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