<?php
/**
 * A class file to represent a characters Armor in the Character Sheet
 */
if(!class_exists('Protective_Item')) {

    class Protective_Item {

        protected $name;
        protected $ac_bonus;
        protected $weight;
        protected $special_properties;

        public function __construct($entries) {
            $this->name = $entries['protective_item_name'];
            $this->ac_bonus = $entries['protective_item_ac_bonus'];
            $this->weight = $entries['protective_item_weight'];
            $this->special_properties = $entries['protective_item_special_properties'];
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