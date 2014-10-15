<?php
/**
 * A class file representing the attacks segment of the character sheet
 */

if(!class_exists('Attacks')) {

    class Attacks {

        protected $base_attack_bonus;
        protected $number_of_attacks;
        protected $attacks_array;

        public function __construct($entries) {
            $this->setBaseAttackBonus($entries['base_attack_bonus']);
            $this->setNumberOfAttacks($entries['attacks_per_round']);
            $this->setAttacksArray($entries['attacks_array']);
        }

        /**
         * @param mixed $attacks_array
         */
        public function setAttacksArray(Array $attacks_array)
        {
            if(is_array($attacks_array) && count($attacks_array) > 0) {
                $this->attacks_array = $attacks_array;
            } else {
                $this->attacks_array = array();
            }

        }

        /**
         * @return mixed
         */
        public function getAttacksArray()
        {
            return $this->attacks_array;
        }

        /**
         * @param mixed $base_attack_bonus
         */
        public function setBaseAttackBonus($base_attack_bonus)
        {
            if(!empty($base_attack_bonus) && $base_attack_bonus >=0) {
                $this->base_attack_bonus = $base_attack_bonus;
            } else {
                $this->base_attack_bonus = 0;
            }

        }

        /**
         * @return mixed
         */
        public function getBaseAttackBonus()
        {
            return $this->base_attack_bonus;
        }

        /**
         * @param mixed $number_of_attacks
         */
        public function setNumberOfAttacks($number_of_attacks)
        {
            if(!empty($number_of_attacks)) {
                $this->number_of_attacks = $number_of_attacks;
            } else {
                $this->number_of_attacks = '1';
            }

        }

        /**
         * @return mixed
         */
        public function getNumberOfAttacks()
        {
            return $this->number_of_attacks;
        }

    }

}