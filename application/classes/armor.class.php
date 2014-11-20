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
            $this->setName($entries['armor_name']);
            $this->setType($entries['armor_type']);
            $this->setAcBonus($entries['armor_ac_bonus']);
            $this->setMaxDex($entries['armor_max_dex']);
            $this->setCheckPenalty($entries['armor_check_penalty']);
            $this->setSpellFailure($entries['armor_spell_failure']);
            $this->setSpeed($entries['armor_speed']);
            $this->setWeight($entries['armor_weight']);
            $this->setSpecialProperties($entries['armor_special_properties']);
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
         * @param mixed $max_dex
         */
        public function setMaxDex($max_dex)
        {
            if(!empty($max_dex) && $max_dex >= 0) {
                $this->max_dex = $max_dex;
            } else {
                $this->max_dex = 0;
            }

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
            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = 'Armor Name';
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
                $this->special_properties = 'Special Properties';
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
         * @param mixed $speed
         */
        public function setSpeed($speed)
        {
            if(!empty($speed) && $speed >= 0) {
                $this->speed = $speed;
            } else {
                $this->speed = 0;
            }

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
         * @param mixed $type
         */
        public function setType($type)
        {
            if(!empty($type) && $type >= 0) {
                $this->type = $type;
            } else {
                $this->type = 1;
            }

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
            if(!empty($weight) && $weight >= 1) {
                $this->weight = $weight;
            } else {
                $this->weight = 1;
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