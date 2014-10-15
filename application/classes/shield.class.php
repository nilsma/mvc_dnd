<?php
/**
 * A class file to represent a characters Armor in the Character Sheet
 */
if(!class_exists('Shield')) {

    class Shield {

        protected $name;
        protected $ac_bonus;
        protected $weight;
        protected $check_penalty;
        protected $spell_failure;
        protected $special_properties;

        public function __construct($entries) {
            $this->setName($entries['shield_name']);
            $this->setAcBonus($entries['shield_ac_bonus']);
            $this->setCheckPenalty($entries['shield_check_penalty']);
            $this->setSpellFailure($entries['shield_spell_failure']);
            $this->setWeight($entries['shield_weight']);
            $this->setSpecialProperties($entries['shield_special_properties']);
        }

        /**
         * @param mixed $ac_bonus
         */
        public function setAcBonus($ac_bonus)
        {
            if(!empty($ac_bonus) && $ac_bonus >= 0) {
                $this->ac_bonus = $ac_bonus;
            } else {
                $this->ac_bonus = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getAcBonus()
        {
            return $this->ac_bonus;
        }

        /**
         * @param mixed $check_penalty
         */
        public function setCheckPenalty($check_penalty)
        {
            if(!empty($check_penalty) && $check_penalty >= 0) {
                $this->check_penalty = $check_penalty;
            } else {
                $this->check_penalty = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getCheckPenalty()
        {
            return $this->check_penalty;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = 'Shield Name';
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
         * @param mixed $special_properties
         */
        public function setSpecialProperties($special_properties)
        {
            if(!empty($special_properties)) {
                $this->special_properties = $special_properties;
            } else {
                $this->special_properties = 'Shield Special Properties';
            }

        }

        /**
         * @return mixed
         */
        public function getSpecialProperties()
        {
            return $this->special_properties;
        }

        /**
         * @param mixed $spell_failure
         */
        public function setSpellFailure($spell_failure)
        {
            if(!empty($spell_failure) && $spell_failure >= 0) {
                $this->spell_failure = $spell_failure;
            } else {
                $this->spell_failure = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getSpellFailure()
        {
            return $this->spell_failure;
        }

        /**
         * @param mixed $weight
         */
        public function setWeight($weight)
        {
            if(!empty($weight) && $weight >= 0) {
                $this->weight = $weight;
            } else {
                $this->weight = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getWeight()
        {
            return $this->weight;
        }

    }

}