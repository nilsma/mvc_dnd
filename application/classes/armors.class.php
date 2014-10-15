<?php
/**
 * A class file to represent the Armors segment of the Character Sheet
 */
if(!class_exists('Armors')) {

    class Armors {

        protected $armor;
        protected $shield;
        protected $protective_items;

        public function __construct($entries) {
            $this->setArmor($entries['armor']);
            $this->setShield($entries['shield']);
            $this->setProtectiveItems($entries['protective_items']);
        }

        /**
         * @param mixed $armor
         */
        public function setArmor(Armor $armor)
        {
            $this->armor = $armor;
        }

        /**
         * @return mixed
         */
        public function getArmor()
        {
            return $this->armor;
        }

        /**
         * @param mixed $protective_items
         */
        public function setProtectiveItems(Array $protective_items)
        {
            $this->protective_items = $protective_items;
        }

        /**
         * @return mixed
         */
        public function getProtectiveItems()
        {
            return $this->protective_items;
        }

        /**
         * @param mixed $shield
         */
        public function setShield(Shield $shield)
        {
            $this->shield = $shield;
        }

        /**
         * @return mixed
         */
        public function getShield()
        {
            return $this->shield;
        }

    }

}