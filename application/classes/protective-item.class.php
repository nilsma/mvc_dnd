<?php
/**
 * A class file to represent a characters Armor in the Character Sheet
 */
if(!class_exists('Protective_Item')) {

    class Protective_Item {

        protected $id;
        protected $name;
        protected $ac_bonus;
        protected $weight;
        protected $special_properties;

        public function __construct($entries, $id = NULL) {
            $this->setId($id);
            $this->setName($entries['protective_item_name']);
            $this->setAcBonus($entries['protective_item_ac_bonus']);
            $this->setWeight($entries['protective_item_weight']);
            $this->setSpecialProperties($entries['protective_item_special_properties']);
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
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
         * @param mixed $name
         */
        public function setName($name)
        {
            if(!empty($name)) {
                $this->name = $name;
            } else {
                $this->name = 'Protective Item Name';
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
                $this->special_properties = 'Protective Item Special Properties';
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