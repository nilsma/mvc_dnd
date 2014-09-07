<?php
/**
 * A class file to represent a characters Armor in the Character Sheet
 */ 
if(!class_exists('Armor')) {
    
    class Armor {

        protected $name;
        protected $type;
        protected $ac_bonus;
        protected $max_dex;
        protected $check_penalty;
        protected $spell_failure;
        protected $speed;
        protected $weight;
        protected $special_properties;
        
        public function __construct($entries) {
            $this->name = $entries['armor_name'];
            $this->type = $entries['armor_type'];
            $this->ac_bonus = $entries['armor_ac_bonus'];
            $this->max_dex = $entries['armor_max_dex'];
            $this->check_penalty = $entries['armor_check_penalty'];
            $this->spell_failure = $entries['armor_spell_failure'];
            $this->speed = $entries['armor_speed'];
            $this->weight = $entries['armor_weight'];
            $this->special_properties = $entries['armor_special_properties'];
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
         * @param mixed $max_dex
         */
        public function setMaxDex($max_dex)
        {
            $this->max_dex = $max_dex;
        }

        /**
         * @return mixed
         */
        public function getMaxDex()
        {
            return $this->max_dex;
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
         * @param mixed $speed
         */
        public function setSpeed($speed)
        {
            $this->speed = $speed;
        }

        /**
         * @return mixed
         */
        public function getSpeed()
        {
            return $this->speed;
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
         * @param mixed $type
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
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