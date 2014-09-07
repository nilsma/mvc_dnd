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
            $this->name = $entries['shield_name'];
            $this->ac_bonus = $entries['shield_ac_bonus'];
            $this->check_penalty = $entries['shield_check_penalty'];
            $this->spell_failure = $entries['shield_spell_failure'];
            $this->weight = $entries['shield_weight'];
            $this->special_properties = $entries['shield_special_properties'];
        }

        /**
         * @param mixed $ac_bonus
         */
        public function setAcBonus($ac_bonus)
        {
            $this->ac_bonus = $ac_bonus;
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
            $this->check_penalty = $check_penalty;
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
         * @param mixed $special_properties
         */
        public function setSpecialProperties($special_properties)
        {
            $this->special_properties = $special_properties;
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
            $this->spell_failure = $spell_failure;
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
            $this->weight = $weight;
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