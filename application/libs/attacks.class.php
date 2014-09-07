<?php
/**
 * A class file representing the attacks segment of the character sheet
 */

if(!class_exists('Attacks')) {

    class Attacks {

        protected $base_attack_bonus;
        protected $number_of_attacks;
        protected $grapple;
        protected $attacks_array;

        public function __construct($entries) {
            $this->base_attack_bonus = $entries['base_attack_bonus'];
            $this->number_of_attacks = $entries['attacks_per_round'];
            $this->grapple = $entries['grapple'];
            $this->attacks_array = $entries['attacks_array'];
        }

        /**
         * @param mixed $attacks_array
         */
        public function setAttacksArray($attacks_array)
        {
            $this->attacks_array = $attacks_array;
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
            $this->base_attack_bonus = $base_attack_bonus;
        }

        /**
         * @return mixed
         */
        public function getBaseAttackBonus()
        {
            return $this->base_attack_bonus;
        }

        /**
         * @param mixed $grapple
         */
        public function setGrapple($grapple)
        {
            $this->grapple = $grapple;
        }

        /**
         * @return mixed
         */
        public function getGrapple()
        {
            return $this->grapple;
        }

        /**
         * @param mixed $number_of_attacks
         */
        public function setNumberOfAttacks($number_of_attacks)
        {
            $this->number_of_attacks = $number_of_attacks;
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